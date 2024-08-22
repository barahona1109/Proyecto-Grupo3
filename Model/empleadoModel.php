<?php
require_once('../Model/conexionModel.php');

class empleadoModel
{
    public static function traerEmpleados()
    {
        try {
            $sql = 'CALL LeerEmpleados';
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function traerEmpleadosid($id)
    {
        try {
            $sql = "CALL VerEmpleadosPorID ($id)";
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function insertarEmpleados($data)
    {
        try {
            $sql = "'" . $data['nombre'] . "'" . ",'" . $data['primerApellido'] . "'" . ",'" . $data['segundoApellido'] . "'" . ",'" . $data['cedula'] . "'";
            $resultado = conexionModel::execute("call InsertarEmpleado($sql)");
            if ($resultado) {
                $sql = 'CALL LeerEmpleados';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al insertar el empleado.');

            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();

        }

    }

    public static function eliminarEmpleados($id)
    {
        try {
            $sql = $id;
            $resultado = conexionModel::execute("call EliminarEmpleado($id)");
            if ($resultado) {
                $sql = 'CALL LeerEmpleados';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al eliminar el empleado.');

            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function modificarEmpleados($data)
    {
        try {
            $sql =  $data['id'] .",'" . $data['nombre'] . "'" . ",'" . $data['primerApellido'] . "'" . ",'" . $data['segundoApellido'] . "'" . ",'" . $data['cedula']. "'";
            $resultado = conexionModel::execute("call ModificarEmpleado($sql)");
            if ($resultado) {
                $sql = 'CALL LeerEmpleados';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al modificar el empleado.');

            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();

        }
    }

}
?>