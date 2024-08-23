<?php   

    require_once('../Model/facturaModel.php');

    class facturasController{

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

        public static function insertar_Facturas($data){
            try {
                return facturaModel::insertarFacturas($data);
                
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        public static function eliminar_Facturas($id){
            try {
                return facturaModel::eliminarFacturas($id);
                
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        
        public static function modificarEmpleados($data){
            try {
                return facturaModel::modificarEmpleados($data);
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }
    }

?>