<?php
require_once('../Controller/usuarioController.php');

$usuarios = usuarioController::obtenerTodosLosUsuarios();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUCE - Gestión de Usuarios</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</head>
<body>
    
    <div id="titulo" class="container">
        <h1>Gestión de Usuarios</h1>
    </div>

    <div id="Secciones" class="container">
        <section id="seccion1">
            <div class="card">
                <h5 class="card-header">Crear Usuario</h5>
                <div class="card-body">
                    <form action="../Controller/usuarioController.php" method="POST">
                        <input type="hidden" name="action" value="crear">
                        <div class="form-group">
                            <label for="usuario">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="id_cargo">ID Cargo</label>
                            <input type="number" class="form-control" id="id_cargo" name="id_cargo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </section>
        
        <section id="seccion2">
            <div class="card">
                <h5 class="card-header">Usuarios Actuales</h5>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre de Usuario</th>
                                <th>Contraseña</th>
                                <th>ID Cargo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['usuario']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['password']); ?></td>
                                <td><?php echo htmlspecialchars($usuario['id_cargo']); ?></td>
                                <td>
                                    
                                    <a href="editar_usuario.php?id=<?php echo htmlspecialchars($usuario['id']); ?>" class="btn btn-warning btn-sm">Editar</a>

                                    
                                    <a href="../Controller/usuarioController.php?action=eliminar&id=<?php echo htmlspecialchars($usuario['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</a>

                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</body>
</html>