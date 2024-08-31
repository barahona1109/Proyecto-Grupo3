<?php
require_once('../Model/conexionModel.php');

class usuarioModelcliente
{
    

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



}
