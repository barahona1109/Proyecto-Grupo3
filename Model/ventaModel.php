<?php
require_once('../Model/conexionModel.php');

class ventaModel
{
    public static function traerVenta()
    {
        try {
            $sql = 'CALL LeerVenta';
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function traerVentaid($id)
    {
        try {
            $sql = "CALL VerVentaPorID ($id)";
            $lista = conexionModel::get_Data($sql);
            return $lista;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function insertarVenta($data)
    {
        try {
            $sql = $data['ID_Venta'] . ", " . $data['id_factura'] . ", " . $data['ID_Producto'] . ", " . $data['Cantidad'] . ", " . $data['Total'] . ", '" . $data['Fecha_Venta'] . "'";
        $resultado = conexionModel::execute("CALL InsertarVenta($sql)");
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

    public static function eliminarVenta($id)
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

    public static function modificarVenta($data)
    {
        try {
            $sql = $data['ID_Venta'] . ", " . $data['id_factura'] . ", " . $data['ID_Producto'] . ", " . $data['Cantidad'] . ", " . $data['Total'] . ", '" . $data['Fecha_Venta'] . "'";
        $resultado = conexionModel::execute("CALL InsertarVenta($sql)");
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