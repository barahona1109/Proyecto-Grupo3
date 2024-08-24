<?php
require_once('../Model/conexionModel.php');

class ventasModel
{
    public static function traerVentas()
    {
        try {
            $sql = 'CALL LeerVentas';
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function traerVentasid($id)
    {
        try {
            $sql = "CALL VerVentasPorID ($id)";
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function insertarVentas($data)
    {
        try {
            $sql = "'" . $data['nombre'] . "'" . ",'" . $data['primerApellido'] . "'" . ",'" . $data['segundoApellido'] . "'" . ",'" . $data['cedula'] . "'";
            $resultado = conexionModel::execute("call InsertarVenta($sql)");
            if ($resultado) {
                $sql = 'CALL LeerVenta';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al insertar la venta.');

            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();

        }

    }

    public static function eliminarVentas($id)
    {
        try {
            $sql = $id;
            $resultado = conexionModel::execute("call EliminarVenta($id)");
            if ($resultado) {
                $sql = 'CALL LeerVenta';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al eliminar la venta.');

            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function modificarVentas($data)
    {
        try {
            $sql =  $data['id'] .",'" . $data['nombre'] . "'" . ",'" . $data['primerApellido'] . "'" . ",'" . $data['segundoApellido'] . "'" . ",'" . $data['cedula']. "'";
            $resultado = conexionModel::execute("call ModificarVenta($sql)");
            if ($resultado) {
                $sql = 'CALL LeerVenta';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al modificar la venta.');

            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();

        }
    }

}
?>