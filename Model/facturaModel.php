<?php
require_once('../Model/conexionModel.php');

class facturasModel
{
    public static function traerFacturas()
    {
        try {
            $sql = 'CALL LeerFacturas';
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function traerFacturasid($id)
    {
        try {
            $sql = "CALL VerFacturasPorID ($id)";
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function insertarFacturas($data)
    {
        try {
            $sql = "'" . $data['nombre'] . "'" . ",'" . $data['primerApellido'] . "'" . ",'" . $data['segundoApellido'] . "'" . ",'" . $data['cedula'] . "'";
            $resultado = conexionModel::execute("call InsertarFactura($sql)");
            if ($resultado) {
                $sql = 'CALL LeerFactura';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al insertar la factura.');

            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();

        }

    }

    public static function eliminarFacturas($id)
    {
        try {
            $sql = $id;
            $resultado = conexionModel::execute("call EliminarFactura($id)");
            if ($resultado) {
                $sql = 'CALL LeerFactura';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al eliminar la factura.');

            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function modificarFacturas($data)
    {
        try {
            $sql =  $data['id'] .",'" . $data['nombre'] . "'" . ",'" . $data['primerApellido'] . "'" . ",'" . $data['segundoApellido'] . "'" . ",'" . $data['cedula']. "'";
            $resultado = conexionModel::execute("call ModificarFactura($sql)");
            if ($resultado) {
                $sql = 'CALL LeerFactura';
                $lista = conexionModel::get_Data($sql);
                return $lista;
            } else {
                throw new Exception('Error al modificar la factura.');

            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();

        }
    }

}
?>