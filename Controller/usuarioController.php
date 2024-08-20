<?php
require_once('../Model/usuarioModel.php');

class usuarioController
{

    public static function crearUsuario()
    {
        // Verificar que se recibieron los datos del formulario
        if (isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['id_cargo'])) {
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $id_cargo = $_POST['id_cargo'];

            // Llamar al método del modelo para crear el usuario
            usuarioModel::crearUsuario($usuario, $password, $id_cargo);

            header('Location: ../View/usuarios.php');
            exit();
        } else {
            echo "Datos incompletos para crear el usuario.";
        }
    }

    public static function obtenerTodosLosUsuarios()
    {
        return usuarioModel::obtenerTodosLosUsuarios();
    }
    public static function obtenerUsuarioPorId($id)
    {
        return usuarioModel::obtenerUsuarioPorId($id);
    }

    public static function actualizarUsuario()
    {
        // Verificar que se recibieron los datos del formulario
        if (isset($_POST['id']) && isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['id_cargo'])) {
            $id = $_POST['id'];
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];
            $id_cargo = $_POST['id_cargo'];

            // Llamar al método del modelo para actualizar el usuario
            usuarioModel::actualizarUsuario($id, $usuario, $password, $id_cargo);

            header('Location: ../View/usuarios.php');
            exit();
        } else {
            echo "Datos incompletos para actualizar el usuario.";
        }
    }

    public static function eliminarUsuario()
    {
        // Verificar que se recibió el ID del usuario a eliminar
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            usuarioModel::eliminarUsuario($id);

            header('Location: ../View/usuarios.php');
            exit();
        } else {
            echo "ID de usuario no proporcionado.";
        }
    }
    public static function procesarAccion()
    {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            switch ($action) {
                case 'crear':
                    self::crearUsuario();
                    break;
                case 'actualizar':
                    self::actualizarUsuario();
                    break;
                case 'eliminar':
                    self::eliminarUsuario();
                    break;
                default:
                    echo "Acción no válida.";
                    break;
            }
        }
    }
}

usuarioController::procesarAccion();
