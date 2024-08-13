<?php
include_once '../Model/conexionModel.php'; 
include_once 'productos.php'; 


$categoria = 'Vestidos';
$productos = obtenerProductos($categoria);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUCE - <?php echo htmlspecialchars($categoria); ?></title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script></head>
        <body>
    <div class="head">
        <nav class="logo">
            <a href="index.html">LUCE</a>
        </nav>
        <nav class="navbar">
            <a href="index.html">Inicio</a>
            <a href="carrito.php">Carrito</a>
            <a href="cuenta.html">Cuenta</a>
            <a href="contacto.html">Contacto</a>
        </nav>
    </div>
    <br>
    <div class="main-container">
    <h2 class="title"><?php echo htmlspecialchars($categoria); ?></h2>
    <div class="container">
        <div class="row row-cols-5">
        <?php
                if (is_array($productos) && !empty($productos)) {
                    foreach ($productos as $producto) {
                        $imagen = htmlspecialchars($producto['imagen']);
                        $nombre = htmlspecialchars($producto['nombre']);
                        $descripcion = isset($producto['Descripcion']) ? htmlspecialchars($producto['Descripcion']) : 'Descripción no disponible';
                        $precio = isset($producto['Precio']) ? number_format($producto['Precio'], 2) : 'Precio no disponible';
                        $idProducto = htmlspecialchars($producto['ID_Producto']);
                        echo '<div class="col">
                                <div class="product-card">
                                    <img src="../img/' . $imagen . '" alt="' . $nombre . '">
                                    <div class="card-body">
                                        <h3>' . $nombre . '</h3>
                                        <p>' . $descripcion . '</p>
                                        <p class="precio">¢' . $precio . '</p>
                                        <a href="../añadir_carrito.php?idProducto=' . $idProducto . '&cantidad=1" class="btn btn-primary">Añadir al carrito</a>
                                </div>
                                </div>
                            </div>';
                    }
                } else {
                    echo '<p>No se encontraron productos.</p>';
                }
                ?>
        </div>
    </div>
</div>

    <br>
</body>
<footer>
    <div class="footer-content">
        <div class="text-center p-2"></div>
        <p class="lead text-center" style="color:white;">&copy; 2024 LUCE. Todos los derechos reservados</p>
    </div>
</footer>
</html>



