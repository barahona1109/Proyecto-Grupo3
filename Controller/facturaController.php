<?php   

    require_once('../Model/facturaModel.php');

    class facturaController{

        public static function ver_traer_FacturaID($id){
            try {
                return facturaModel::traerfacturasid($id);
                
            } catch (Exception $e) {   
                echo "Error: ". $e->getMessage();
            }
        }

        public static function ver_traer_Facturas(){
            try {
                return facturaModel::traerFacturas();
                
            } catch (\Exception $e) {   
                echo "Error: ". $e->getMessage();
            }
        }

        public static function insertar_Factura($data){
            try {
                return facturaModel::insertarFacturas($data);
                
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        public static function eliminar_Factura($id){
            try {
                return facturaModel::eliminarFacturas($id);
                
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        
        public static function modificarFactura($data){
            try {
                return facturaModel::modificarFacturas($data);
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }
    }

?>