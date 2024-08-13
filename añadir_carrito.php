<?php
include_once 'Model/conexionModel.php';

if (isset($_GET['idProducto']) && isset($_GET['cantidad'])) {
    $idProducto = intval($_GET['idProducto']);
    $cantidad = intval($_GET['cantidad']);

    if ($idProducto > 0 && $cantidad > 0) {
        // Prepara la consulta para llamar al procedimiento almacenado
        $query = "CALL agregar_producto_carrito(?, ?)";
        $params = [$idProducto, $cantidad];
        
        // Ejecuta la consulta
        $exito = conexionModel::execute($query, $params);

        $mensaje = $exito ? 'Producto añadido al carrito con éxito.' : 'Error al añadir el producto al carrito.';
        $estado = $exito ? 'success' : 'error';

        // Utiliza la URL del referer para redirigir a la página anterior
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'index.php';
        header("Location: $referer?mensaje=" . urlencode($mensaje) . "&estado=" . urlencode($estado));
        exit();
    } else {
        $mensaje = 'Datos inválidos: idProducto o cantidad no válidos.';
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