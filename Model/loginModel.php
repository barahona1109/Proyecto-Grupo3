<?php 
    require_once('../Model/conexionModel.php');

    class loginModel {

        public static function validarUsuario($data) {
            try {
                $username = $data['username'];
                $password = $data['password'];
        
                // Consulta SQL con placeholders para los parámetros
                $consulta = "SELECT * FROM usuarios WHERE usuario = ? AND password = ?";
                $params = [$username, $password];
        
                // Ejecutar la consulta utilizando la función execute
                $resultado = conexionModel::execute($consulta, $params);
        
                // Verificar si la consulta se ejecutó correctamente
                if ($resultado['exito']) {
                    $filas = mysqli_fetch_array($resultado['exito']);
        
                    if ($filas && isset($filas['id_cargo'])) {
                        session_start();
                        $_SESSION['user_id'] = $filas['id']; // Almacenar el ID del usuario en la sesión
                        $_SESSION['user_name'] = $filas['usuario']; // Almacenar el nombre de usuario en la sesión
                        $_SESSION['user_role'] = $filas['id_cargo']; // Almacenar el rol del usuario en la sesión
        
                        if ($filas['id_cargo'] == 1) { // Administrador
                            header("Location: ../View/homeAdmin.php");
                        } elseif ($filas['id_cargo'] == 2) { // Cliente
                            header("Location: ../View/index.php");
                        }
                        exit(); // Asegurarse de que el script se detenga después de la redirección
                    } else {
                        include("../View/cuenta.php");
                        echo "<p>Error en la autenticación</p>";
                    }
        
                    mysqli_free_result($resultado['exito']);
                } else {
                    echo "Error en la consulta: " . $resultado['error'];
                }
        
                // Cerrar la conexión
                $resultado['conexion']->close();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

    }

?>