<?php
require_once("../Controller/loginController.php");

if (isset($_GET['action'])) {

    switch ($_GET['action']) {

        case 'login':
            loginController::inicioSesion($_POST);
            break;
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/bootstrap/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS y Popper.js (Necesario para que funcione el modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="head">
        <div class="logo">
            <a href="index.php">LUCE</a>
        </div>
        <nav class="navbar">
            <a href="index.php">Inicio</a>
            <a href="carrito.php">Carrito</a>
            <a href="cuenta.php">Cuenta</a>
            <a href="contacto.html">Contacto</a>
        </nav>
    </div>
    <br>

    <!-- Modal de error -->
    



    <div class="main-container">
        <section class="login-section">
            <h2 class="title">Iniciar Sesión</h2>
            <form action="../View/cuenta.php?action=login" method="post">
                <input type="text" placeholder="Usuario" required name="username">
                <input type="password" placeholder="Contraseña" required name="password">
                <button type="submit" class="btn btn-warning">Ingresar</button>
            </form>
            <div class="login-links">
                <a href="../View/UsuariosCliente.php" class="btn btn-outline-warning">Registrarse</a>
            </div>
        </section>
    </div>






    <footer>
        <div class="footer-content">
            <div class="text-center p-2"></div>
            <p class="lead text-center" style="color:white;">&copy; 2024 LUCE. Todos los derechos reservados</p>
        </div>
    </footer>

    <script>
        // Comprobar si hay un error en la URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            // Si el parámetro error está presente, mostrar el modal
            $('#errorModal').modal('show');
        }
    </script>

</html>