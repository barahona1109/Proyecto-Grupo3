<?php
require_once("../Controller/loginController.php");

        if(isset($_GET['action'])){

            switch($_GET['action']){
        
                case 'cerrar':
                    loginController::cierreSesion();
                    break;
            }
        }
    

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página Principal</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="styleAdmin.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/f89ba662a1.js" crossorigin="anonymous"></script>
    <!-- Estilos personalizados -->
    <style>
        .container {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <nav id="barranav" class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item-Cerrar">
                        <a class="nav-link-cerrar" href="../View/homeAdmin?action=cerrar"><i class="fa-solid fa-right-from-bracket"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="titulo" class="container">
        <h1>Bienvenido Administrador</h1>
    </div>
    <div id="Secciones" class="container">
        <section id="seccion1">
            <h2 id="title_seccion">Posibles funcionalidades deseadas</h2>
            <div class="card">
                <div id="cardVentas" class=container>
                    <h5 class="card-header">Ventas</h5>
                    <div class="card-body">
                        <h5 class="card-title">Record de Ventas</h5>
                        <p class="card-text">Aqui puede encontrar un resumen de las ventas realizadas a lo largo del
                            funcionamiento de la empresa.
                            Ademas, puede administrar las mismas.
                        </p>
                        <a href="../View/ventas.php" class="btn btn-outline-danger"><i class="fa-solid fa-cubes"></i>Vamos!</i></a>
                    </div>
                </div>
                <div id="cardFacturas" class="container">
                    <h5 class="card-header">Facturas</h5>
                    <div class="card-body">
                        <h5 class="card-title">Record de Facturas</h5>
                        <p class="card-text">Aqui puede encontrar un resumen de las facturas realizadas a lo largo del
                            funcionamiento de la empresa.
                            Ademas, puede administrar las mismas.
                        </p>
                        <a href="../View/facturas.php" class="btn btn-outline-danger"><i class="fa-solid fa-cubes"></i>Vamos!</a>
                    </div>

                </div>

                <div id="cardUsuarios" class="container">
                    <h5 class="card-header">Usuarios</h5>
                    <div class="card-body">
                        <h5 class="card-title">Record de Usuarios</h5>
                        <p class="card-text">Aqui puede encontrar los usuarios activos en la empresa. Ademas puede
                            administrarlos.
                        </p>
                        <a href="../View/usuarios.php" class="btn btn-outline-danger"><i class="fa-solid fa-cubes"></i>Vamos!</a>
                    </div>
                </div>
                <div id="cardEmpleados" class="container">
                    <h5 class="card-header">Empleados</h5>
                    <div class="card-body">
                        <h5 class="card-title">Record de Empleados</h5>
                        <p class="card-text">Aqui puede encontrar los Empleados activos en la empresa. Ademas puede
                            administrarlos.
                        </p>
                        <a href="../View/empleados.php" class="btn btn-outline-danger"><i class="fa-solid fa-cubes"></i>Vamos!</a>
                    </div>

                </div>
        </section>

    </div>


</body>

</html>