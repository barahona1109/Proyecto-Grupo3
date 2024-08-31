<?php
require_once('../Controller/usuarioController.php');


$verUsuarios = usuarioController::ver_traer_Usuarios();
$verUsuarioID = [];

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    switch ($action) {
        case 'insertar':
            usuarioController::insertar_Usuario($_POST);
            header("Location: ../View/usuarios.php?mensaje=Usuario insertado correctamente");
            exit();
        case "modificar":
            $modificarUsuario = usuarioController::modificarUsuario($_POST);
            header("Location: ../View/usuarios.php?mensaje=Usuario modificado correctamente");
            exit();
        case 'eliminar':
            if ($id) {
                $eliminarUsuario = usuarioController::eliminar_Usuario($id);

                if ($eliminarUsuario) {
                    header("Location: ../View/usuarios.php?mensaje=Usuario eliminado correctamente");
                } else {
                    echo "Error al eliminar el usuario.";
                }
            } else {
                echo "ID no proporcionado.";
            }
            break;
        case 'ver':
            if ($id) {
                $verUsuarioID = usuarioController::ver_traer_UsuariosID($id);

                if (!$verUsuarioID) {
                    echo "Error al traer el usuario.";
                }
            } else {
                echo "ID no proporcionado.";
            }
            break;
        default:
            echo "Acción no válida.";
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="styleAdmin.css">
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
                <a id="hometitle" class="navbar-brand" href="../View/homeAdmin.php">Home</a>
            </div>
        </nav>
    </div>
    
    <div class="modal fade" id="modifyModal" tabindex="-1" aria-labelledby="modifyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyModalLabel">Modificar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modifyForm" action="../View/usuarios.php?action=modificar" method="post">
                        <input type="hidden" name="id" value="<?= htmlspecialchars(isset($verUsuarioID[0]['id']) ? $verUsuarioID[0]['id'] : '') ?>">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars(isset($verUsuarioID[0]['nombre']) ? $verUsuarioID[0]['nombre'] : '') ?>" required>
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" name="usuario" value="<?= htmlspecialchars(isset($verUsuarioID[0]['usuario']) ? $verUsuarioID[0]['usuario'] : '') ?>" required>
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" name="password" value="<?= htmlspecialchars(isset($verUsuarioID[0]['password']) ? $verUsuarioID[0]['password'] : '') ?>" required>
                            <label for="id_cargo" class="form-label">Cargo</label>
                            <input type="text" class="form-control" name="id_cargo" value="<?= htmlspecialchars(isset($verUsuarioID[0]['id_cargo']) ? $verUsuarioID[0]['id_cargo'] : '') ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-center p-3">USUARIOS</h1>
    <div class="container-fluid row">
        <form action="../View/usuarios.php?action=insertar" method="post" class="col-4 p-3">
            <h4 id="title" class="text-center">Registro de Usuarios</h4>
            <div class="mb-3">
                <label id="titleInputs" for="nombre" class="form-label">Nombre del usuario</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="usuario" class="form-label">Tipo de usuario</label>
                <input type="text" class="form-control" name="usuario">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="id_cargo" class="form-label">Cargo</label>
                <input type="text" class="form-control" name="id_cargo">
            </div>
            <button type="submit" class="btn btn-danger" name="Crear" value="Ok">Crear</button>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead id="tabla" class="bg-info">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Password</th>
                        <th scope="col">Cargo</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($verUsuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id'] ?></td>
                            <td><?= $usuario['nombre'] ?></td>
                            <td><?= $usuario['usuario'] ?></td>
                            <td><?= $usuario['password'] ?></td>
                            <td><?= $usuario['id_cargo'] ?></td>
                            <td>
                                <a href="../View/usuarios.php?action=ver&id=<?= $usuario['id'] ?>"
                                    class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="../View/usuarios.php?action=eliminar&id=<?= $usuario['id'] ?>"
                                    class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (isset($_GET['action']) && $_GET['action'] === 'ver' && !empty($verUsuarioID)): ?>
        <script>
            var modifyModal = new bootstrap.Modal(document.getElementById('modifyModal'));
            modifyModal.show();
        </script>
    <?php endif; ?>
</body>

</html>