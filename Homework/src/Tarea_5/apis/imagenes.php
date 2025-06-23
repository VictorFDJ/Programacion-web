<?php include('../header.php'); ?>

<h2 class="text-center mb-4">8️⃣ Generador de Imágenes con IA 🖼️</h2>

<div class="row justify-content-center">
  <div class="col-md-6">
    <form method="GET" class="mb-4">
      <label for="palabra" class="form-label">Palabra clave para buscar imagen:</label>
      <input type="text" name="palabra" id="palabra" class="form-control" placeholder="Ej. naturaleza, tecnología" required>
      <button type="submit" class="btn btn-info w-100 mt-3">Buscar Imagen</button>
    </form>

    <?php
    if (isset($_GET['palabra']) && !empty(trim($_GET['palabra']))) {
        $keyword = htmlspecialchars(trim($_GET['palabra']));
        $pixabayKey = "51005105-299a80aec134e2d0e63ceb055";
        $pixabayUrl = "https://pixabay.com/api/?key={$pixabayKey}&q=" . urlencode($keyword) . "&image_type=photo&per_page=1&lang=es";

        $response = @file_get_contents($pixabayUrl);

        if ($response === FALSE) {
            echo "<div class='alert alert-danger'>❌ Error al conectar con el servicio de imágenes. Intenta más tarde.</div>";
        } else {
            $data = json_decode($response, true);
            if ($data['totalHits'] > 0) {
                $imgUrl = $data['hits'][0]['webformatURL'];
                echo "
                <div class='card text-center shadow p-3'>
                  <h4>Imagen para <strong>{$keyword}</strong></h4>
                  <img src='{$imgUrl}' alt='{$keyword}' class='img-fluid mx-auto' style='max-width: 100%; height: auto;'>
                </div>
                ";
            } else {
                echo "<div class='alert alert-warning'>⚠️ No se encontró ninguna imagen para <strong>{$keyword}</strong>.</div>";
            }
        }
    }
    ?>
  </div>
</div>

<?php include('../footer.php'); ?>
