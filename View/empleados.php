<?php
require_once('../Controller/empleadoController.php');

$verEmpleados = empleadoController::ver_traer_Empleados();
$verEmpleadoID = [];

// Verificar si se ha pasado la acción a realizar
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    switch ($action) {
        case 'insertar':
            empleadoController::insertar_Empleados($_POST);
            header("Location: ../View/empleados.php?mensaje=Empleado insertado correctamente");
            exit();
        case "modificar":
            $modificarEmpleado = empleadoController::modificarEmpleados($_POST);
            header("Location: ../View/empleados.php?mensaje=Empleado modificado correctamente");

            exit();


        case 'eliminar':
            if ($id) {
                $eliminarEmpleado = empleadoController::eliminar_Empleados($id);

                if ($eliminarEmpleado) {
                    header("Location: ../View/empleados.php?mensaje=Empleado eliminado correctamente");
                } else {
                    echo "Error al eliminar el empleado.";
                }
            } else {
                echo "ID no proporcionado.";
            }
            break;

        case 'ver':
            if ($id) {
                $verEmpleadoID = empleadoController::ver_traer_EmpleadosID($id);

                if (!$verEmpleadoID) {
                    echo "Error al traer el empleado.";
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
    <title>Empleados</title>
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
        <nav id="barranav" class="navbar" >
            <div class="container-fluid">
                <a id="hometitle" class="navbar-brand" href="../View/homeAdmin.php">Home</a>
            </div>
        </nav>
    </div>

    <div class="modal fade" id="idModal" tabindex="-1" aria-labelledby="idModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idModalLabel">Buscar Empleado por ID</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="searchForm" action="../View/empleados.php?action=modificar" method="post">
                        <div class="mb-3">
                            <?php if (!empty($verEmpleadoID)): ?>
                                <?php foreach ($verEmpleadoID as $empleado): ?>
                                    <label for="idempleado" class="form-label">ID del empleado</label>
                                    <input type="text" class="form-control" name="id" required
                                        value="<?= $empleado['ID_Empleado'] ?>">
                                    <label for="nombreEmp" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" required
                                        value="<?= $empleado['Nombre'] ?>">
                                    <label for="NumCedula" class="form-label">Numero de cedula</label>
                                    <input type="text" class="form-control" name="cedula" required
                                        value="<?= $empleado['Num_Cedula_Empleado'] ?>">
                                    <label for="PrimerApellido" class="form-label">Primer Apellido</label>
                                    <input type="text" class="form-control" name="primerApellido" required
                                        value="<?= $empleado['Primer_Apellido'] ?>">
                                    <label for="SegundoApellido" class="form-label">segundoApellido</label>
                                    <input type="text" class="form-control" name="segundoApellido" required
                                        value="<?= $empleado['Segundo_Apellido'] ?>">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No se ha seleccionado ningún empleado para editar.</p>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Modificar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-center p-3">USUARIOS</h1>
    <div class="container-fluid row">
        <form action="../View/empleados.php?action=insertar" method="post" class="col-4 p-3">
            <h4 id="title" class="text-center">Registro de Empleados</h4>
            <div class="mb-3">
                <label id="titleInputs" for="exampleInputEmail1" class="form-label">Nombre del empleado</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <div class="mb-3">
                <label id="titleInputs"  for="exampleInputEmail1" class="form-label">Numero de cedula</label>
                <input type="text" class="form-control" name="cedula">
            </div>
            <div class="mb-3">
                <label id="titleInputs"  for="exampleInputEmail1" class="form-label">Primer Apellido</label>
                <input type="text" class="form-control" name="primerApellido">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="exampleInputEmail1" class="form-label">Segundo Apellido</label>
                <input type="text" class="form-control" name="segundoApellido">
            </div>
            <button type="submit" class="btn btn-danger" name="Crear" value="Ok">Crear</button>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead id="tabla" class="bg-info">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Numero de cedula</th>
                        <th scope="col">Primer Apellido</th>
                        <th scope="col">Segundo Apellido</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($verEmpleados as $empleado): ?>
                        <tr>
                            <td><input type="hidden" name="id[]"
                                    value="<?= $empleado['ID_Empleado'] ?>"><?= $empleado['ID_Empleado'] ?>
                            </td>
                            <td><input type="text" class="form-control" name="nombre[]" value="<?= $empleado['Nombre'] ?>">
                            </td>
                            <td><input type="text" class="form-control" name="cedula[]"
                                    value="<?= $empleado['Num_Cedula_Empleado'] ?>"></td>
                            <td><input type="text" class="form-control" name="primerApellido[]"
                                    value="<?= $empleado['Primer_Apellido'] ?>"></td>
                            <td><input type="text" class="form-control" name="segundoApellido[]"
                                    value="<?= $empleado['Segundo_Apellido'] ?>"></td>
                            <td>
                                <a href="../View/empleados.php?action=ver&id=<?= $empleado['ID_Empleado'] ?>"
                                    class="btn btn-small btn-danger"><i class="fa-solid fa-floppy-disk"></i></a>
                                <a href="../View/empleados.php?action=eliminar&id=<?= $empleado['ID_Empleado'] ?>"
                                    class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (isset($action) && $action == 'ver' && !empty($verEmpleadoID)): ?>
        <script>
            var idModal = new bootstrap.Modal(document.getElementById('idModal'));
            idModal.show();
        </script>
    <?php endif; ?>
</body>

</html>