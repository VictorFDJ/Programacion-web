<?php
include("../../libreria/principal.php");
define("PAGINA_ACTUAL", "estadisticas");
Plantilla::aplicar();

$personajes = Dbx::list("personajes");
$profesiones = Dbx::list("profesiones");

$edad_total = 0;
$sexcom = 0;
$salario_total = 0;

$mayor_salario = null;
$menor_salario = null;

$profesion_mayor_salario = null;
$profesion_menor_salario = null;

$personasXprofesion = [];
$labels = [];
$salarios = [];

foreach ($profesiones as $profesion) {
    $salario = $profesion->salario_mensual;
    $salario_total += $salario;

    $labels[] = $profesion->nombre;
    $salarios[] = $salario;

    if ($mayor_salario === null || $salario > $mayor_salario) {
        $mayor_salario = $salario;
        $profesion_mayor_salario = $profesion->nombre;
    }

    if ($menor_salario === null || $salario < $menor_salario) {
        $menor_salario = $salario;
        $profesion_menor_salario = $profesion->nombre;
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
$salario_promedio = $salario_total / count($profesiones);

$data = [
    'personajes' => count($personajes),
    'profesiones' => count($profesiones),
    'edad_promedio' => $eprom,
    'nivel_experiencia_comun' => $sexcom,
    'mayor_salario' => $mayor_salario,
    'menor_salario' => $menor_salario,
    'profesion_mayor_salario' => $profesion_mayor_salario,
    'profesion_menor_salario' => $profesion_menor_salario,
    'salario_promedio' => $salario_promedio
];

$labels_json = json_encode($labels);
$salarios_json = json_encode($salarios);
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
                        <?php foreach ($personasXprofesion as $fila): ?>
                            <li class="list-group-item"><?= $fila['nombre']; ?>: <?= $fila['cantidad']; ?> personajes</li>
                        <?php endforeach; ?>
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
                                <span class="text-muted">Profesión con mayor salario: <?= $data['profesion_mayor_salario']; ?></span>
                                <span class="fw-bold">RD$<?= number_format($data['mayor_salario'], 0); ?></span>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Profesión con menor salario: <?= $data['profesion_menor_salario']; ?></span>
                                <span class="fw-bold">RD$<?= number_format($data['menor_salario'], 0); ?></span>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Salario promedio:</span>
                                <span class="fw-bold">RD$<?= number_format($data['salario_promedio'], 0); ?></span>
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
                    <h5 class="card-title fw-bold text-dark text-center mb-4">Distribución de salarios por categoría de profesión</h5>
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
    const labels = <?= $labels_json ?>;
    const data = <?= $salarios_json ?>;

    const ctx = document.getElementById('salaryChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: labels.map(() => '#FF69B4'),
                borderWidth: 0,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => 'RD$' + value.toLocaleString()
                    },
                    grid: { color: 'rgba(0,0,0,0.1)' }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
