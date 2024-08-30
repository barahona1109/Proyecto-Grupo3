<?php
require_once('../Model/conexionModel.php');

class facturaModel
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
            $sql =  $data['Num_Factura']. ", '" . $data['Num_Cedula'] ."'". ", " . $data['ID_Producto'] . ", " . $data['ID_Empleado'] . ", '" . $data['Costo_Envio'] ."'". ", '" . $data['Total_factura']."'";
            $resultado = conexionModel::execute("CALL InsertarFactura($sql)");
            if ($resultado) {
                $sql = 'CALL LeerFacturas';
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
                $sql = 'CALL LeerFacturas';
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
            $sql = $data['idfactura'] . ", " . $data['Num_Factura'] . ", '" . $data['Num_Cedula'] . "', " 
            . $data['ID_Producto'] . ", " . $data['ID_Empleado'] . ", " . $data['Costo_Envio'] . ", " 
            . $data['Total_factura'];
            $resultado = conexionModel::execute("CALL ModificarFactura($sql)");
            if ($resultado) {
                $sql = 'CALL LeerFacturas';
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