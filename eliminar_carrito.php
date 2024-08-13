<?php
include_once 'Model/conexionModel.php';

if (isset($_GET['idProducto'])) {
    $idProducto = intval($_GET['idProducto']);

    if ($idProducto > 0) {
        $query = "CALL eliminar_producto_carrito(?)";
        $resultado = conexionModel::execute($query, [$idProducto]);

        $mensaje = $resultado ? 'Producto eliminado del carrito con éxito.' : 'Error al eliminar el producto del carrito.';
        $estado = $resultado ? 'success' : 'error';

        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
        header("Location: $referer?mensaje=" . urlencode($mensaje) . "&estado=" . urlencode($estado));
        exit();
    } else {
        $mensaje = 'Datos inválidos: idProducto no válido.';
        $estado = 'error';
        header("Location: index.php?mensaje=" . urlencode($mensaje) . "&estado=" . urlencode($estado));
        exit();
    }
} else {
    $mensaje = 'Datos inválidos.';
    $estado = 'error';
    header("Location: index.php?mensaje=" . urlencode($mensaje) . "&estado=" . urlencode($estado));
    exit();
}
?>
