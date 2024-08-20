<?php
include_once '../Model/conexionModel.php';
function obtenerProductosCarrito()
{
    $query = "SELECT c.id_producto, p.nombre, p.descripcion, p.precio, p.imagen, c.cantidad
              FROM carrito c
              INNER JOIN productos p ON c.id_producto = p.ID_Producto";
    $resultado = conexionModel::get_data($query);
    return $resultado;
}

$productosCarrito = obtenerProductosCarrito();

$subtotal = 0;
foreach ($productosCarrito as $producto) {
    $subtotal += $producto['precio'] * $producto['cantidad'];
}

$envio = 2500;
$total = $subtotal + $envio;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUCE</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/f89ba662a1.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="head">
        <div class="logo">
            <a href="index.php">LUCE</a>
        </div>
        <nav class="navbar">
            <a href="index.php">Inicio</a>
            <a href="carrito.php">Carrito</a>
            <a href="cuenta.php">Cuenta</a>
            <a href="contacto.html">Contacto</a>
        </nav>
    </div>

    <br>
    <section class="main-container">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-lg-7">
                                <h5 class="mb-3"><a href="index.html" class="text-body"><i
                                            class="fas fa-long-arrow-alt-left me-2"></i>Seguir Comprando</a></h5>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div>
                                        <p class="mb-1">Carrito de Compras</p>
                                    </div>
                                </div>

                                <?php if (is_array($productosCarrito) && !empty($productosCarrito)) : ?>
                                    <?php foreach ($productosCarrito as $producto) : ?>
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div>
                                                        <img src="../img/<?php echo htmlspecialchars($producto['imagen']); ?>" class="img-fluid rounded-3" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" style="width: 65px;">
                                                        </div>
                                                        <div class="ms-3">
                                                            <h5><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                                            <p class="small mb-0"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row align-items-center">
                                                        <div style="width: 50px;">
                                                            <h5 class="fw-normal mb-0"><?php echo htmlspecialchars($producto['cantidad']); ?></h5>
                                                        </div>
                                                        <div style="width: 80px;">
                                                            <h5 class="mb-0">¢<?php echo number_format($producto['precio'], 2); ?></h5>
                                                        </div>
                                                        <a href="../eliminar_carrito.php?idProducto=<?php echo htmlspecialchars($producto['id_producto']); ?>" style="color: #cecece;">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p>No hay productos en el carrito.</p>
                                <?php endif; ?>

                            </div>
                            <div class="col-lg-5">
                                <hr class="my-4">
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Subtotal</p>
                                    <p class="mb-2">¢<?php echo number_format($subtotal, 2); ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="mb-2">Envío</p>
                                    <p class="mb-2">¢<?php echo number_format($envio, 2); ?></p>
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <p class="mb-2">Total (IVA incluido)</p>
                                    <p class="mb-2">¢<?php echo number_format($total, 2); ?></p>
                                </div>
                                <button type="button" class="btn btn-info btn-block btn-lg">
                                    <div class="d-flex justify-content-between">
                                        <span>Pagar <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                    </div>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<footer>
    <div class="footer-content">
        <div class="text-center p-2"></div>
        <p class="lead text-center" style="color:white;">&copy; 2024 LUCE. Todos los derechos reservados</p>
    </div>
</footer>

</html>