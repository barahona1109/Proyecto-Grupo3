<?php
session_start(); // Iniciar la sesión

$isLoggedIn = isset($_SESSION['user_id']); // Verificar si el usuario ha iniciado sesión

// Obtener el nombre de usuario si está disponible
$userName = $isLoggedIn ? $_SESSION['user_name'] : '';


require_once("../Controller/loginController.php");

if (isset($_GET['action'])) {

    switch ($_GET['action']) {

        case 'cerrar':
            loginController::cierreSesion();
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUCE</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/f89ba662a1.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/f89ba662a1.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="head">
        <nav class="logo">
            <a href="index.php">LUCE</a>
        </nav>
        <nav class="navbar">
            <a href="index.php">Inicio</a>
            <a href="carrito.php">Carrito</a>
            <a href="cuenta.php">Cuenta</a>
            <a href="contacto.php">Contacto</a>

            <?php if ($isLoggedIn): ?>
                <div class="avisoInicio"><i class="fa-solid fa-user"></i><span class="navbar-text">Bienvenido,
                        <?= htmlspecialchars($userName) ?>!</span></div>
                <a href="../View/index?action=cerrar" class="btncerrar">Cerrar sesión</a>
            <?php else: ?>
                <a id="iniciarsesion" href="../View/cuenta.php" class="btniniciar">Iniciar sesión</a>
            <?php endif; ?>
        </nav>
    </div>

    <br>
    <div class="main-container">
        <h2 class="title">Productos</h2>
        <p>Descubre nuestra exclusiva colección de productos en tendencia que destacan por su calidad y estilo. Cada
            artículo ha sido cuidadosamente seleccionado para ofrecerte lo mejor en moda y comodidad.</p>
        <div class="box-container">
            <div class="box" style="background-image: url('../img/Vestido.jpg');">
                <a href="./vestidos.php" class="btn">Vestidos</a>
            </div>
            <div class="box" style="background-image: url('../img/Blazer.jpg');">
                <a href="./blusas.php" class="btn">Blusas</a>
            </div>
            <div class="box" style="background-image: url('../img/Sueter.jpg');">
                <a href="./abrigos.php" class="btn">Abrigos</a>
            </div>
            <div class="box" style="background-image: url('../img/Nsueta.jpg');">
                <a href="./niños.php" class="btn">Niños</a>
            </div>
        </div>
        <br><br>
        <h2 class="title">Contacto</h2>
        <p>Puedes seguirnos en nuestra página de Instagram para no perderte ninguna novedad.</p>
        <div class="Ins">
            <a href="https://www.instagram.com/_luce.cr/" class="btn">Instagram <i
                    class="fa-brands fa-instagram"></i></a>
        </div>
        <br>
    </div>
</body>

<footer>
    <div class="footer-content">
        <div class="text-center p-2"></div>
        <p class="lead text-center" style="color:white;">&copy; 2024 LUCE. Todos los derechos reservados</p>
    </div>
</footer>

</html>