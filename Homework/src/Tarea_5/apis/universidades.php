<?php include('../header.php'); ?>

<h2 class="text-center mb-4">🎓 Universidades de República Dominicana</h2>

<div class="row justify-content-center mb-4">
  <div class="col-md-6">
    <form method="GET" class="d-flex" role="search">
      <input 
        class="form-control me-2" 
        type="search" 
        placeholder="Buscar universidad por nombre..." 
        aria-label="Buscar" 
        name="buscar" 
        value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>"
      >
      <button class="btn btn-primary" type="submit">Buscar</button>
    </form>
  </div>
</div>

<?php
$universidades = [
    ["nombre" => "Universidad Dominico-Americana", "url" => "http://www.icda.edu.do/espanol/unicda/"],
    ["nombre" => "Instituto Tecnológico de Santo Domingo", "url" => "http://www.intec.edu.do/"],
    ["nombre" => "Instituto Tecnológico de Las Américas", "url" => "https://itla.edu.do/"],
    ["nombre" => "Universidad Católica Madre y Maestra", "url" => "http://www.pucmm.edu.do/"],
    ["nombre" => "Universidad Agroforestal Fernando A.Meriño", "url" => "http://www.uafam.edu.do/"],
    ["nombre" => "Universidad Abierta Para Adultos", "url" => "http://www.uapa.edu.do/"],
    ["nombre" => "Universidad Autónoma de Santo Domingo", "url" => "http://www.uasd.edu.do/"],
    ["nombre" => "Universidad Católica Tecnológica del Cibao", "url" => "http://www.ucateci.edu.do/"],
    ["nombre" => "Universidad Central del Este", "url" => "http://www.uce.edu.do/"],
    ["nombre" => "Universidad Católica Nordestana", "url" => "http://www.ucne.edu.do/"],
    ["nombre" => "Universidad Católica de Santo Domingo", "url" => "http://www.ucsd.edu.do/"],
    ["nombre" => "Universidad Dominicana O&M", "url" => "http://www.udoym.edu.do/"],
    ["nombre" => "Universidad Federico Henríquez y Carvajal", "url" => "http://www.ufhec.edu.do/"],
    ["nombre" => "Universidad Adventista Dominicana", "url" => "http://www.unad.edu.do/"],
    ["nombre" => "Universidad APEC", "url" => "http://www.unapec.edu.do/"],
    ["nombre" => "Universidad Experimental Felix Adam", "url" => "http://www.unefa.edu.do/"],
    ["nombre" => "Universidad Nacional Evangélica", "url" => "http://www.unev-rd.edu.do/"],
    ["nombre" => "Universidad Iberoamericana", "url" => "http://www.unibe.edu.do/"],
    ["nombre" => "Universidad Interamericana", "url" => "http://www.unica.edu.do/"],
    ["nombre" => "Universidad del Caribe", "url" => "http://www.unicaribe.edu.do/"],
    ["nombre" => "Universidad Eugenio Maria de Hostos", "url" => "http://www.uniremhos.edu.do/"],
    ["nombre" => "Universidad Nacional Pedro Henríquez Ureña", "url" => "http://www.unphu.edu.do/"],
    ["nombre" => "Universidad Odontológica Dominicana", "url" => "http://www.uod.edu.do/"],
    ["nombre" => "Universidad de la Tercera Edad", "url" => "http://www.ute.edu.do/"],
    ["nombre" => "Universidad Tecnológica de Santiago", "url" => "http://www.utesa.edu/"],
    ["nombre" => "Universidad Tecnológica del Sur", "url" => "http://www.utesur.edu.do/"],
];

// Filtrar si hay búsqueda
$buscar = isset($_GET['buscar']) ? trim(strtolower($_GET['buscar'])) : '';

$universidades_filtradas = array_filter($universidades, function($uni) use ($buscar) {
    if ($buscar === '') return true;
    return strpos(strtolower($uni['nombre']), $buscar) !== false;
});
?>

<div class="row justify-content-center">
  <div class="col-md-8">
    <?php if(count($universidades_filtradas) > 0): ?>
      <ul class="list-group">
        <?php foreach($universidades_filtradas as $uni): ?>
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php echo htmlspecialchars($uni['nombre']); ?>
            <a href="<?php echo htmlspecialchars($uni['url']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">Visitar</a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <div class="alert alert-warning text-center">
        ⚠️ No se encontraron universidades que coincidan con "<?php echo htmlspecialchars($buscar); ?>".
      </div>
    <?php endif; ?>
  </div>
</div>

<?php include('../footer.php'); ?>
