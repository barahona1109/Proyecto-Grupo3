<?php
require_once('../Model/conexionModel.php');

class usuarioModel
{
    public static function traerUsuarios()
    {
        try {
            $sql = 'CALL LeerUsuarios';
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function traerUsuarioPorID($id)
    {
        try {
            $sql = "CALL VerUsuarioPorID ($id)";
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function insertarUsuario($data)
    {
        try {
            $sql = "'" . $data['nombre'] . "', '" . $data['usuario'] . "', '" . $data['password'] . "', " . $data['id_cargo'];
            $resultado = conexionModel::execute("CALL InsertarUsuario($sql)");

            if ($resultado) {
                $sql = 'CALL LeerUsuarios';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al insertar el usuario.');
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public static function eliminarUsuario($id)
    {
        try {
            $sql = $id;
            $resultado = conexionModel::execute("call EliminarUsuario($id)");
            if ($resultado) {
                $sql = 'CALL LeerUsuarios';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al eliminar el usuario.');
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function modificarUsuario($data)
{
    try {
        if (empty($data['id']) || empty($data['nombre']) || empty($data['usuario']) || empty($data['password']) || empty($data['id_cargo'])) {
            throw new Exception('Datos incompletos para modificar el usuario.');
        }

        $sql = "CALL ModificarUsuario(?, ?, ?, ?, ?)";
        $params = [
            $data['id'],
            $data['nombre'],
            $data['usuario'],
            $data['password'],
            $data['id_cargo']
        ];

        $resultado = conexionModel::execute($sql, $params);

        if ($resultado) {
            $sql = 'CALL LeerUsuarios';
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } else {
            throw new Exception('Error al modificar el usuario.');
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
}
