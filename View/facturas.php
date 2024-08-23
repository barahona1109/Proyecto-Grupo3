<?php
require_once('../Controller/facturaController.php');

$verFacturas = facturaController::ver_traer_Facturas s();
$verFacturaID = [];

// Verificar si se ha pasado la acción a realizar
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    switch ($action) {
        case 'insertar':
            facturaController::insertar_Facturas($_POST);
            header("Location: ../View/facturas.php?mensaje=Factura insertado correctamente");
            exit();
        case "modificar":
            $modificarFactura = facturaController::modificarFacturas($_POST);
            header("Location: ../View/facturas.php?mensaje=Factura modificado correctamente");

            exit();


        case 'eliminar':
            if ($id) {
                $eliminarFactura = facturaController::eliminar_Facturas($id);

                if ($eliminarFactura) {
                    header("Location: ../View/facturas.php?mensaje=Factura eliminado correctamente");
                } else {
                    echo "Error al eliminar la factura.";
                }
            } else {
                echo "ID no proporcionado.";
            }
            break;

        case 'ver':
            if ($id) {
                $verFacturaID = facturaController::ver_traer_FacturasID($id);

                if (!$verFacturaID) {
                    echo "Error al traer la factura.";
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
    <title>Facturas</title>
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
                    <h5 class="modal-title" id="idModalLabel">Buscar Factura por ID</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="searchForm" action="../View/facturas.php?action=modificar" method="post">
                        <div class="mb-3">
                            <?php if (!empty($verFacturaID)): ?>
                                <?php foreach ($verFacturaID as $factura): ?>
                                    <label for="idfactura" class="form-label">ID de la factura</label>
                                    <input type="text" class="form-control" name="idfactura" required
                                        value="<?= $factura['ID_Factura'] ?>">
                                    <label for="Num_Factura" class="form-label">Num_Factura</label>
                                    <input type="text" class="form-control" name="Num_Factura" required
                                        value="<?= $factura['Num_Factura'] ?>">
                                    <label for="NumCedula" class="form-label">Numero de cedula</label>
                                    <input type="text" class="form-control" name="Num_Cedula" required
                                        value="<?= $factura['Num_Cedula'] ?>">
                                    <label for="ID_Producto" class="form-label">ID_Producto</label>
                                    <input type="text" class="form-control" name="ID_Producto" required
                                        value="<?= $factura['ID_Producto'] ?>">
                                        <label for="ID_Empleado" class="form-label">ID del Empleado</label>
                                    <input type="text" class="form-control" name="ID_Empleado" required
                                        value="<?= $factura['ID_Empleado'] ?>">
                                    <label for="Costo_Envio" class="form-label">Costo de Envío</label>
                                    <input type="text" class="form-control" name="Costo_Envio" required
                                        value="<?= $factura['Costo_Envio'] ?>">
                                    <label for="Total_factura" class="form-label">Total de la Factura</label>
                                    <input type="text" class="form-control" name="Total_factura" required
                                        value="<?= $factura['Total_factura'] ?>">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No se ha seleccionado ninguna factura para editar.</p>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Modificar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-center p-3">FACTURAS</h1>
    <div class="container-fluid row">
        <form action="../View/facturas.php?action=insertar" method="post" class="col-4 p-3">
            <h4 id="title" class="text-center">Registro de Facturas</h4>
            <div class="mb-3">
                <label id="titleInputs" for="Num_Factura" class="form-label">Número de Factura</label>
                <input type="text" class="form-control" name="Num_Factura">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="Num_Cedula" class="form-label">Número de Cédula</label>
                <input type="text" class="form-control" name="Num_Cedula">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="ID_Producto" class="form-label">ID del Producto</label>
                <input type="text" class="form-control" name="ID_Producto">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="ID_Empleado" class="form-label">ID del Empleado</label>
                <input type="text" class="form-control" name="ID_Empleado">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="Costo_Envio" class="form-label">Costo de Envío</label>
                <input type="text" class="form-control" name="Costo_Envio">
            </div>
            <div class="mb-3">
                <label id="titleInputs" for="Total_factura" class="form-label">Total de la Factura</label>
                <input type="text" class="form-control" name="Total_factura">
            </div>
            <button type="submit" class="btn btn-danger" name="Crear" value="Ok">Crear</button>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead id="tabla" class="bg-info">
                    <tr>
                    <th scope="col">ID</th>
                        <th scope="col">Número de Factura</th>
                        <th scope="col">Número de Cédula</th>
                        <th scope="col">ID del Producto</th>
                        <th scope="col">ID del Empleado</th>
                        <th scope="col">Costo de Envío</th>
                        <th scope="col">Total de la Factura</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($verFacturas as $factura): ?>
                        <tr>
                        <td><input type="hidden" name="idfactura[]"
                                    value="<?= $factura['idfactura'] ?>"><?= $factura['idfactura'] ?>
                            </td>
                            <td><input type="text" class="form-control" name="Num_Factura[]" value="<?= $factura['Num_Factura'] ?>">
                            </td>
                            <td><input type="text" class="form-control" name="Num_Cedula[]"
                                    value="<?= $factura['Num_Cedula'] ?>"></td>
                            <td><input type="text" class="form-control" name="ID_Producto[]"
                                    value="<?= $factura['ID_Producto'] ?>"></td>
                            <td><input type="text" class="form-control" name="ID_Empleado[]"
                                    value="<?= $factura['ID_Empleado'] ?>"></td>
                            <td><input type="text" class="form-control" name="Costo_Envio[]"
                                    value="<?= $factura['Costo_Envio'] ?>"></td>
                            <td><input type="text" class="form-control" name="Total_factura[]"
                                    value="<?= $factura['Total_factura'] ?>"></td>
                            <td>
                                <a href="../View/facturas.php?action=ver&id=<?= $factura['idfactura'] ?>"
                                    class="btn btn-small btn-danger"><i class="fa-solid fa-floppy-disk"></i></a>
                                <a href="../View/facturas.php?action=eliminar&id=<?= $factura['idfactura'] ?>"
                                    class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if (isset($action) && $action == 'ver' && !empty($verFacturaID)): ?>
        <script>
            var idModal = new bootstrap.Modal(document.getElementById('idModal'));
            idModal.show();
        </script>
    <?php endif; ?>
</body>

</html>