@extends('layouts.admin')

@section('title', 'EStadísticas')

@section('title_component', 'Panel Estadísticas')

@section('content')

<div class="container">

    <form id="filter-form" method="GET" class="mb-4">
        <div class="form-group">
            <label for="periodo">Selecciona un Periodo:</label>
            <select name="periodo" id="periodo" class="form-control input input_select">
                <option value="">Todos los periodos</option>
                @foreach ($periodos as $periodo)
                    <option value="{{ $periodo->id }}" {{ $selectedPeriodo == $periodo->id ? 'selected' : '' }}>
                        {{ $periodo->numeroPeriodo }} - {{ $periodo->periodo }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Chart 1 -->
    <div class="chart-wrapper mb-5">
   
        <div id="chart"></div>
    </div>

    <!-- Chart 2 -->
    <div class="chart-wrapper mb-5">
   
        <div id="chartEmpresas"></div>
    </div>

    <!-- Chart 3 -->
    <div class="chart-wrapper mb-5">
      
        <div id="chartEmpresasII"></div>
    </div>
</div>

<style>
    .chart-wrapper {
        border: 1px solid #ddd; /* Borde para el recuadro */
        padding: 15px;           /* Espacio interno */
        border-radius: 10px;     /* Bordes redondeados */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Sombra */
        background-color: #fff;  /* Fondo blanco */
        max-width: 100%;         /* Asegura que el contenedor no se salga del ancho disponible */
        margin: 0 auto;          /* Centra el contenedor si hay espacio disponible */
        overflow-x: auto;        /* Agrega un scroll horizontal si el contenido se desborda */
    }

    .chart-title {
        font-size: 18px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 15px;
    }

    #chart, #chartEmpresas, #chartEmpresasII {
        height: 400px; /* Altura de las gráficas */
        width: 100%;  /* Asegura que la gráfica no exceda el ancho del contenedor */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Función para convertir texto a mayúsculas preservando caracteres especiales
    function toUpperCaseSpecial(str) {
        return str.toLocaleUpperCase('es-ES'); // Convertir texto a mayúsculas preservando tildes
    }

    // Configuración de la primera gráfica (Estudiantes en Proyectos)
    var chartOptions = {
        chart: {
            type: 'bar',
            height: 'auto',
            toolbar: {
                show: true,
                tools: {
                    download: true,
                }
            },
            zoom: {
                enabled: true
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
            },
            padding: {
                right: 10,
                left: 10
            }
        },
        series: [{
            name: 'Estudiantes',
            data: {!! json_encode($chartData) !!}
        }],
        xaxis: {
            categories: {!! json_encode($categories) !!}.map(toUpperCaseSpecial), // Convertir categorías a mayúsculas
            labels: {
                style: {
                    fontSize: '12px',
                    fontFamily: 'Arial, sans-serif',
                    whiteSpace: 'nowrap',
                    overflow: 'hidden',
                    textOverflow: 'ellipsis'
                },
            },
            title: {
                text: 'NÚMERO DE ESTUDIANTES',
                offsetY: 10,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#263238'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    fontSize: '12px',
                    fontFamily: 'Arial, sans-serif',
                    cursor: 'pointer'
                },
                tooltip: {
                    enabled: true,
                    formatter: function(value) {
                        return value;
                    }
                }
            },
            title: {
                text: 'PROYECTOS SOCIALES',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#263238'
                }
            },
        },
        legend: {
            show: false,  // Ocultar leyenda
        },
        tooltip: {
            enabled: true,
            shared: false,
            intersect: true,
            x: {
                show: false,
            },
            y: {
                formatter: function(val) {
                    return new Intl.NumberFormat().format(val) + " estudiantes";
                }
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '70%',
                distributed: true,
            },
        },
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return new Intl.NumberFormat().format(val);
            },
            style: {
                fontSize: '12px',
                colors: ['#ffffff']
            }
        },
        colors: ['#242c72', '#3642A5', '#3768DB', '#41A4FF'], // Colores personalizados
        title: {
            text: 'ESTUDIANTES EN PROYECTOS SOCIALES',
            align: 'center',
            margin: 10,
            offsetY: 0,
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                color: '#263238'
            }
        },
        responsive: [
            {
                breakpoint: 768,  // Móvil
                options: {
                    chart: {
                        height: 400
                    },
                    xaxis: {
                        labels: {
                            style: {
                                fontSize: '10px'  // Etiquetas más pequeñas en dispositivos pequeños
                            }
                        }
                    }
                }
            }
        ]
    };

    var chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
    chart.render();

    // Configuración de la segunda gráfica (Estudiantes por Empresa - Practicas I)
    var chartEmpresasOptions = {
        chart: {
            type: 'bar',
            height: 'auto',
            toolbar: {
                show: true,
                tools: {
                    download: true,
                }
            },
            zoom: {
                enabled: true
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
            },
            padding: {
                right: 10,
                left: 10
            }
        },
        series: [{
            name: 'Estudiantes',
            data: {!! json_encode($estudiantesPorEmpresa) !!}
        }],
        xaxis: {
            categories: {!! json_encode($empresas) !!}.map(toUpperCaseSpecial), // Convertir categorías a mayúsculas
            title: {
                text: 'NÚMERO DE ESTUDIANTES',
                offsetY: 10,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#263238'
                }
            },
            labels: {
                formatter: function(val) {
                    return new Intl.NumberFormat().format(val);
                },
                style: {
                    fontSize: '12px',
                    fontFamily: 'Arial, sans-serif',
                    whiteSpace: 'nowrap',
                    overflow: 'hidden',
                    textOverflow: 'ellipsis'
                },
            }
        },
        yaxis: {
            labels: {
                style: {
                    fontSize: '12px',
                    fontFamily: 'Arial, sans-serif',
                },
            },
            title: {
                text: 'EMPRESAS',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#263238'
                }
            }
        },
        legend: {
            show: false,  // Ocultar leyenda
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '70%',
                distributed: true,
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return new Intl.NumberFormat().format(val);
            },
            style: {
                fontSize: '12px',
                colors: ['#ffffff']
            }
        },
        colors: ['#242c72', '#3642A5', '#3768DB', '#41A4FF'], // Colores personalizados
        title: {
            text: 'ESTUDIANTES POR EMPRESAS - PRÁCTICAS I',
            align: 'center',
            margin: 10,
            offsetY: 0,
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                color: '#263238'
            }
        },
        responsive: [
            {
                breakpoint: 768,  // Móvil
                options: {
                    chart: {
                        height: 400
                    },
                    xaxis: {
                        labels: {
                            style: {
                                fontSize: '10px'  // Etiquetas más pequeñas en dispositivos pequeños
                            }
                        }
                    }
                }
            }
        ]
    };

    var chartEmpresas = new ApexCharts(document.querySelector("#chartEmpresas"), chartEmpresasOptions);
    chartEmpresas.render();

    // Configuración de la tercera gráfica (Estudiantes por Empresa - Practicas II)
    var chartEmpresasIIOptions = {
        chart: {
            type: 'bar',
            height: 'auto',
            toolbar: {
                show: true,
                tools: {
                    download: true,
                }
            },
            zoom: {
                enabled: true
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
            },
            padding: {
                right: 10,
                left: 10
            }
        },
        series: [{
            name: 'Estudiantes',
            data: {!! json_encode($estudiantesPorEmpresaII) !!}
        }],
        xaxis: {
            categories: {!! json_encode($empresasII) !!}.map(toUpperCaseSpecial), // Convertir categorías a mayúsculas
            title: {
                text: 'NÚMERO DE ESTUDIANTES',
                offsetY: 10,
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#263238'
                }
            },
            labels: {
                formatter: function(val) {
                    return new Intl.NumberFormat().format(val);
                },
                style: {
                    fontSize: '12px',
                    fontFamily: 'Arial, sans-serif',
                    whiteSpace: 'nowrap',
                    overflow: 'hidden',
                    textOverflow: 'ellipsis'
                },
            }
        },
        yaxis: {
            labels: {
                style: {
                    fontSize: '12px',
                    fontFamily: 'Arial, sans-serif',
                },
            },
            title: {
                text: 'EMPRESAS',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#263238'
                }
            }
        },
        legend: {
            show: false,  // Ocultar leyenda
        },
        plotOptions: {
            bar: {
                horizontal: true,
                barHeight: '70%',
                distributed: true,
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return new Intl.NumberFormat().format(val);
            },
            style: {
                fontSize: '12px',
                colors: ['#ffffff']
            }
        },
        colors: ['#242c72', '#3642A5', '#3768DB', '#41A4FF'], // Colores personalizados
        title: {
            text: 'ESTUDIANTES POR EMPRESAS - PRÁCTICAS II',
            align: 'center',
            margin: 10,
            offsetY: 0,
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
                color: '#263238'
            }
        },
        responsive: [
            {
                breakpoint: 768,  // Móvil
                options: {
                    chart: {
                        height: 400
                    },
                    xaxis: {
                        labels: {
                            style: {
                                fontSize: '10px'  // Etiquetas más pequeñas en dispositivos pequeños
                            }
                        }
                    }
                }
            }
        ]
    };

    var chartEmpresasII = new ApexCharts(document.querySelector("#chartEmpresasII"), chartEmpresasIIOptions);
    chartEmpresasII.render();

    // Manejo del cambio de filtro con AJAX
    document.getElementById('periodo').addEventListener('change', function() {
        var periodoId = this.value;
        var url = "{{ route('dashboard.filter') }}?periodo=" + periodoId;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Actualizar datos de la gráfica de proyectos
                chart.updateOptions({
                    xaxis: {
                        categories: data.categories.map(toUpperCaseSpecial) // Convertir categorías a mayúsculas
                    },
                    series: [{
                        name: 'Estudiantes',
                        data: data.chartData
                    }]
                });

                // Actualizar datos de la gráfica de empresas para Practicas I
                chartEmpresas.updateOptions({
                    xaxis: { // Actualizar xaxis para empresas
                        categories: data.empresas.map(toUpperCaseSpecial) // Convertir categorías a mayúsculas
                    },
                    series: [{
                        name: 'Estudiantes',
                        data: data.estudiantesPorEmpresa
                    }]
                });

                // Actualizar datos de la gráfica de empresas para Practicas II
                chartEmpresasII.updateOptions({
                    xaxis: { // Actualizar xaxis para empresas
                        categories: data.empresasII.map(toUpperCaseSpecial) // Convertir categorías a mayúsculas
                    },
                    series: [{
                        name: 'Estudiantes',
                        data: data.estudiantesPorEmpresaII
                    }]
                });
            })
            .catch(error => console.error('Error al cargar los datos:', error));
    });
</script>

@endsection
