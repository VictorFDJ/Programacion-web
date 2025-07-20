<?php
session_start();
?>

<?php include 'header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4" style="color:white">Iniciar Sesión</h3>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form action="procesar_login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label"style="color:white">Correo electrónico</label>
                    <input type="email" name="email" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label"style="color:white">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
