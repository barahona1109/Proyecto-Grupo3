<?php
require_once('../Controller/ventaController.php');

$verVentas = ventaController::ver_traer_Ventas();
$verVentaID = [];

// Verificar si se ha pasado la acción a realizar
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    switch ($action) {
        case 'insertar':
            ventaController::insertar_Venta($_POST);
            header("Location: ../View/venta.php?mensaje=Venta insertado correctamente");
            exit();
        case "modificar":
            $modificarVenta = ventaController::modificarVenta($_POST);
            header("Location: ../View/venta.php?mensaje=Venta modificado correctamente");

            exit();


        case 'eliminar':
            if ($id) {
                $eliminarVenta = ventaController::eliminar_Venta($id);

                if ($eliminarVenta) {
                    header("Location: ../View/venta.php?mensaje=Venta eliminado correctamente");
                } else {
                    echo "Error al eliminar la venta.";
                }
            } else {
                echo "ID no proporcionado.";
            }
            break;

        case 'ver':
            if ($id) {
                $verVentaID = ventaController::ver_traer_VentaID($id);

                if (!$verVentaID) {
                    echo "Error al traer la venta.";
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
    <title>Ventas</title>
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

    <div class="modal fade" id="idModal" tabindex="-1" aria-labelledby="idModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="idModalLabel">Buscar Venta por ID</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="searchForm" action="../View/venta.php?action=modificar" method="post">
                        <div class="mb-3">
                            <?php if (!empty($verVentaID)): ?>
                                <?php foreach ($verVentaID as $venta): ?>
                                    <label for="ID_Venta" class="form-label">ID de la Venta</label>
                                    <input type="text" class="form-control" name="id" required
                                        value="<?= $venta['ID_Venta'] ?>">
                                    <label for="id_factura" class="form-label">ID Factura</label>
                                    <input type="text" class="form-control" name="id_factura" required
                                        value="<?= $venta['id_factura'] ?>">
                                    <label for="ID_Producto" class="form-label">ID Producto</label>
                                    <input type="text" class="form-control" name="ID_Producto" required
                                        value="<?= $venta['ID_Producto'] ?>">
                                    <label for="Cantidad" class="form-label">Cantidad</label>
                                    <input type="text" class="form-control" name="Cantidad" required
                                        value="<?= $venta['Cantidad'] ?>">
                                    <label for="Total" class="form-label">Total</label>
                                    <input type="text" class="form-control" name="Total" required
                                        value="<?= $venta['Total'] ?>">
                                    <label for="Fecha_Venta" class="form-label">Fecha de Venta</label>
                                    <input type="text" class="form-control" name="Fecha_Venta" required
                                        value="<?= $venta['Fecha_Venta'] ?>">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No se ha seleccionado ninguna venta para editar.</p>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Modificar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-center p-3">Ventas</h1>
    <div class="container-fluid row">
        <form action="../View/venta.php?action=insertar" method="post" class="col-4 p-3">
            <h4 id="title" class="text-center">Registro de Ventas</h4>
            <div class="mb-3">
                <label id="titleInputs" for="exampleInputEmail1" class="form-label">ID Factura</label>
                <input type="text" class="form-control" name="id_factura">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="exampleInputEmail1" class="form-label">ID Producto</label>
                <input type="text" class="form-control" name="ID_Producto">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="exampleInputEmail1" class="form-label">Cantidad</label>
                <input type="text" class="form-control" name="Cantidad">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="exampleInputEmail1" class="form-label">Total</label>
                <input type="text" class="form-control" name="Total">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="exampleInputEmail1" class="form-label">Fecha de Venta</label>
                <input type="datetime-local" class="form-control" name="Fecha_Venta">
            </div>
            <button type="submit" class="btn btn-danger" name="Crear" value="Ok">Crear</button>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead id="tabla" class="bg-info">
                    <tr>
                        <th scope="col">ID Venta</th>
                        <th scope="col">ID Factura</th>
                        <th scope="col">ID Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Total</th>
                        <th scope="col">Fecha de Venta</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($verVentas as $venta): ?>
                        <tr>
                            <td><input type="hidden" name="id[]"
                                    value="<?= $venta['ID_Venta'] ?>"><?= $venta['ID_Venta'] ?>
                            </td>
                            <td><input type="text" class="form-control" name="id_factura[]"
                                    value="<?= $venta['id_factura'] ?>"></td>
                            <td><input type="text" class="form-control" name="ID_Producto[]"
                                    value="<?= $venta['ID_Producto'] ?>"></td>
                            <td><input type="text" class="form-control" name="Cantidad[]"
                                    value="<?= $venta['Cantidad'] ?>"></td>
                            <td><input type="text" class="form-control" name="Total[]"
                                    value="<?= $venta['Total'] ?>"></td>
                            <td><input type="text" class="form-control" name="Fecha_Venta[]"
                                    value="<?= $venta['Fecha_Venta'] ?>"></td>
                            <td>
                                <a href="../View/venta.php?action=ver&id=<?= $venta['ID_Venta'] ?>"
                                    class="btn btn-small btn-danger"><i class="fa-solid fa-floppy-disk"></i></a>
                                <a href="../View/venta.php?action=eliminar&id=<?= $venta['ID_Venta'] ?>"
                                    class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (isset($action) && $action == 'ver' && !empty($verVentaID)): ?>
        <script>
            var idModal = new bootstrap.Modal(document.getElementById('idModal'));
            idModal.show();
        </script>
    <?php endif; ?>
</body>

</html>