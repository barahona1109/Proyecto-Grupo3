<?php
include_once '../Model/conexionModel.php';

function obtenerProductos($categoria) {
    $query = "SELECT * FROM productos WHERE categoria = ?";
    $productos = conexionModel::get_data($query, [$categoria]);
    return is_array($productos) ? $productos : [];
}
?>


