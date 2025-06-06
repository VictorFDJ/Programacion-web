<?php
include("../../libreria/principal.php");
define("PAGINA_ACTUAL", "estadisticas");
Plantilla::aplicar();
$personajes = Dbx::list("personajes");
$profesiones = Dbx::list("profesiones");

$edad_total = 0;
$sexcom = 0; // Nivel de experiencia común

$mayor_salario = null;
$menor_salario = null;

$personasXprofesion = [];
foreach ($profesiones as $profesion) {
    if ($mayor_salario === null || $profesion->salario_mensual > $mayor_salario) {
        $mayor_salario = $profesion->salario_mensual;
    }

    if ($menor_salario === null || $profesion->salario_mensual < $menor_salario) {
        $menor_salario = $profesion->salario_mensual;
    }

    if (!isset($personasXprofesion[$profesion->idx])) {
        $personasXprofesion[$profesion->idx] = [
            'nombre' => $profesion->nombre,
            'cantidad' => 0
        ];
    }
}

foreach ($personajes as $personaje) {
    $edad_total += $personaje->edad();
    $sexcom += $personaje->nivel_experiencia;

    if (isset($personasXprofesion[$personaje->profesion])) {
        $personasXprofesion[$personaje->profesion]['cantidad']++;
    }
}

$eprom = $edad_total / count($personajes);
$sexcom = $sexcom / count($personajes);

$data = [
    'personajes' => count($personajes),
    'profesiones' => count($profesiones),
    'edad_promedio' => $eprom,
    'nivel_experiencia_comun' => $sexcom, // Valor fijo para el ejemplo
    
];










?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>


<div class="container-fluid p-4">
    <!-- Título -->
    <div class="text-center mb-4">
        <h1 class="text-dark fw-bold">🌸 Estadísticas del Mundo Barbie 🌸</h1>
    </div>

    <!-- Tarjetas principales -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-primary text-white h-100 shadow">
                <div class="card-body text-center">
                    <h3 class="card-title">👥 Personajes</h3>
                    <h2 class="display-4 fw-bold"><?= $data['personajes']; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-secondary text-white h-100 shadow">
                <div class="card-body text-center">
                    <h3 class="card-title">💼 Profesiones</h3>
                    <h2 class="display-4 fw-bold"><?= $data['profesiones']; ?></h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-success text-white h-100 shadow">
                <div class="card-body text-center">
                    <h3 class="card-title">📅 Edad Promedio</h3>
                    <h2 class="display-6 fw-bold"><?= number_format($data['edad_promedio'], 0); ?></h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card bg-warning text-white h-100 shadow">
                <div class="card-body text-center">
                    <h3 class="card-title">⭐ Nivel de Experiencia</h3>
                    <h4 class="fw-bold"><?= number_format($data['nivel_experiencia_comun'], 0); ?></h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenido inferior -->
    <div class="row">
        <!-- Columna izquierda -->
        <div class="col-lg-6">
            <!-- Distribución de personajes -->
            <div class="card mb-4 shadow">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-dark mb-3">Distribución de personajes por categoría</h5>
                    <ul class="list-unstyled">


                        <?php
                        foreach ($personasXprofesion as $idx => $fila) {
                            echo '<li class="list-group-item">' . $fila['nombre'] . ': ' . $fila['cantidad'] . ' personajes</li>';
                        }

                        ?>

                    </ul>
                </div>
            </div>

            <!-- Salarios destacados -->
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-dark mb-3">Salarios destacados</h5>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Profesión con mayor salario: Ingeniera Robótica</span>
                                <span class="fw-bold">RD$250,000</span>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Profesión con menor salario: Artista de plastilina</span>
                                <span class="fw-bold">RD$35,000</span>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Salario promedio:</span>
                                <span class="fw-bold">RD$120,000</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Personaje con mayor salario: Barbie CEO</span>
                                <span class="fw-bold">RD$300,000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna derecha - Gráfico -->
        <div class="col-lg-6">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-dark text-center mb-4">Distribución de salarios por categoría de
                        profesión</h5>
                    <div class="text-center">
                        <small class="text-muted d-block mb-3">Salario Promedio (RD$)</small>
                    </div>
                    <div style="position: relative; height: 350px;">
                        <canvas id="salaryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Configuración del gráfico
    const ctx = document.getElementById('salaryChart').getContext('2d');
    const salaryChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Ciencia', 'Arte', 'Educación', 'Salud', 'Tecnología'],
            datasets: [{
                data: [180000, 85000, 120000, 150000, 250000],
                backgroundColor: [
                    '#FF69B4',
                    '#FFB6C1',
                    '#FF1493',
                    '#DA70D6',
                    '#FF69B4'
                ],
                borderWidth: 0,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return 'RD$' + value.toLocaleString();
                        }
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.1)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>