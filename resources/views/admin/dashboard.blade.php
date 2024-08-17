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
            <h2>Estudiantes por Empresa</h2>
            <div id="chartEmpresas"></div>
        </div>
    </div>

    <script>
        // Configuración inicial de la gráfica de Proyectos
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
                show: false,
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
                    horizontal: true, // Cambiamos el gráfico a horizontal
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

        // Configuración inicial de la gráfica de Empresas como gráfica de barras horizontales
        var chartEmpresasOptions = {
            chart: {
                type: 'bar', // Gráfico de barras
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
                    }
                }
            },
            yaxis: {
                categories: {!! json_encode($empresas) !!}, // Categorías en yaxis para mostrar los nombres de las empresas
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
            plotOptions: {
                bar: {
                    horizontal: true, // Gráfico de barras horizontales
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
            colors: ['#FF6347'],
            title: {
                text: 'Estudiantes por Empresa',
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

        // Manejo del cambio de filtro con AJAX
        document.getElementById('periodo').addEventListener('change', function() {
            var periodoId = this.value;
            var url = "{{ route('dashboard.filter') }}?periodo=" + periodoId;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Actualizar los datos de la gráfica de Proyectos
                    chart.updateOptions({
                        xaxis: {
                            categories: data.categories
                        },
                        series: [{
                            name: 'Estudiantes',
                            data: data.chartData
                        }]
                    });

                    // Actualizar los datos de la gráfica de Empresas
                    chartEmpresas.updateOptions({
                        yaxis: { // Actualiza el yaxis para las categorías (nombres de empresas)
                            categories: data.empresas
                        },
                        series: [{
                            name: 'Estudiantes',
                            data: data.estudiantesPorEmpresa
                        }]
                    });
                })
                .catch(error => console.error('Error al cargar los datos:', error));
        });
    </script>

@endsection

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
