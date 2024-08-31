<?php
require_once('../Controller/usuarioControllercliente.php');



if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    switch ($action) {
        case 'insertarcliente':
            usuarioControllercliente::insertar_Usuario($_POST);
            header("Location: ../View/usuariosCliente.php?mensaje=Usuario insertado correctamente");
            exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f89ba662a1.js" crossorigin="anonymous"></script>
</head>

<body>
    <div>
        <nav id="barranav" class="navbar">
            <div class="container-fluid">
                <a id="hometitle" class="navbar-brand" href="../View/cuenta.php">Home</a>
            </div>
        </nav>
    </div>


    <h1 class="text-center p-3">USUARIOS</h1>
    <div class="container-fluid row">
        <form action="../View/usuariosCliente.php?action=insertarcliente" method="post" class="col-4 p-3">
            <h4 id="title" class="text-center">Registro de Usuarios</h4>
            <div class="mb-3">
                <label id="titleInputs" for="nombre" class="form-label">Nombre del usuario</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <input value="cliente" type="hidden" name="usuario">
            <div class="mb-3">
                <label id="titleInputs" for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password">
            </div>

            <input value="2" type="hidden" name="id_cargo">
            <button type="submit" class="btn btn-warning" name="Crear" value="Ok">Crear</button>
        </form>
    </div>

</body>

</html>