@extends('layouts.admin')

@section('title', 'Panel Aceptación')

@section('title_component', 'Panel Estudiantes')

@section('content')

<div class="container">
    <h1>Estudiantes en Proyectos</h1>

    <form id="filter-form" method="GET" class="mb-4">
        <div class="form-group">
            <label for="periodo">Selecciona un Periodo:</label>
            <select name="periodo" id="periodo" class="form-control">
                <option value="">Todos los periodos</option>
                @foreach ($periodos as $periodo)
                    <option value="{{ $periodo->id }}" {{ $selectedPeriodo == $periodo->id ? 'selected' : '' }}>
                        {{ $periodo->numeroPeriodo }} - {{ $periodo->periodo }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="chart-container mb-5">
        <div id="chart"></div>
    </div>

    <div class="chart-container mb-5">
        <h2>Estudiantes por Empresa - Practicas I</h2>
        <div id="chartEmpresas"></div>
    </div>

    <div class="chart-container mb-5">
        <h2>Estudiantes por Empresa - Practicas II</h2>
        <div id="chartEmpresasII"></div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Setup configuration for the first chart (Estudiantes en Proyectos)
    var chartOptions = {
        chart: {
            type: 'bar',
            height: 600,
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
        },
        series: [{
            name: 'Estudiantes',
            data: {!! json_encode($chartData) !!}
        }],
        xaxis: {
            categories: {!! json_encode($categories) !!},
            labels: {
                style: {
                    fontSize: '12px',
                    fontFamily: 'Arial, sans-serif',
                },
            },
            title: {
                text: 'Número de estudiantes',
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
                text: 'Proyectos sociales',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#263238'
                }
            },
        },
        legend: {
            show: false,  // Disable legend
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
                colors: ['#000']
            }
        },
        colors: ['#1E90FF', '#FF6347', '#32CD32', '#FFD700', '#8A2BE2'],
        title: {
            text: 'Estudiantes por Proyecto',
            align: 'center',
            margin: 10,
            offsetY: 0,
            style: {
                fontSize: '20px',
                fontWeight: 'bold',
                color: '#263238'
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
    chart.render();

    // Setup configuration for the second chart (Estudiantes por Empresa - Practicas I)
    var chartEmpresasOptions = {
        chart: {
            type: 'bar',
            height: 600,
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
        },
        series: [{
            name: 'Estudiantes',
            data: {!! json_encode($estudiantesPorEmpresa) !!}
        }],
        xaxis: {
            categories: {!! json_encode($empresas) !!},
            title: {
                text: 'Número de estudiantes',
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
                text: 'Empresas',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#263238'
                }
            }
        },
        legend: {
            show: false,  // Disable legend
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
                colors: ['#000']
            }
        },
        colors: ['#FF6347', '#32CD32', '#1E90FF', '#FFD700', '#8A2BE2'], // Match the colors as needed
        title: {
            text: 'Estudiantes por Empresa - Practicas I',
            align: 'center',
            margin: 10,
            offsetY: 0,
            style: {
                fontSize: '20px',
                fontWeight: 'bold',
                color: '#263238'
            }
        }
    };

    var chartEmpresas = new ApexCharts(document.querySelector("#chartEmpresas"), chartEmpresasOptions);
    chartEmpresas.render();

    // Setup configuration for the third chart (Estudiantes por Empresa - Practicas II)
    var chartEmpresasIIOptions = {
        chart: {
            type: 'bar',
            height: 600,
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
        },
        series: [{
            name: 'Estudiantes',
            data: {!! json_encode($estudiantesPorEmpresaII) !!}
        }],
        xaxis: {
            categories: {!! json_encode($empresasII) !!},
            title: {
                text: 'Número de estudiantes',
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
                text: 'Empresas',
                style: {
                    fontSize: '14px',
                    fontWeight: 'bold',
                    color: '#263238'
                }
            }
        },
        legend: {
            show: false,  // Disable legend
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
                colors: ['#000']
            }
        },
        colors: ['#FF6347', '#32CD32', '#1E90FF', '#FFD700', '#8A2BE2'], // Match the colors as needed
        title: {
            text: 'Estudiantes por Empresa - Practicas II',
            align: 'center',
            margin: 10,
            offsetY: 0,
            style: {
                fontSize: '20px',
                fontWeight: 'bold',
                color: '#263238'
            }
        }
    };

    var chartEmpresasII = new ApexCharts(document.querySelector("#chartEmpresasII"), chartEmpresasIIOptions);
    chartEmpresasII.render();

    // Handle filter change with AJAX
    document.getElementById('periodo').addEventListener('change', function() {
        var periodoId = this.value;
        var url = "{{ route('dashboard.filter') }}?periodo=" + periodoId;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                // Update project chart data
                chart.updateOptions({
                    xaxis: {
                        categories: data.categories
                    },
                    series: [{
                        name: 'Estudiantes',
                        data: data.chartData
                    }]
                });

                // Update company chart data for Practicas I
                chartEmpresas.updateOptions({
                    xaxis: { // Update xaxis for companies
                        categories: data.empresas
                    },
                    series: [{
                        name: 'Estudiantes',
                        data: data.estudiantesPorEmpresa
                    }]
                });

                // Update company chart data for Practicas II
                chartEmpresasII.updateOptions({
                    xaxis: { // Update xaxis for companies
                        categories: data.empresasII
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
