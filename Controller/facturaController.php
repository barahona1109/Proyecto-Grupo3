<?php   

    require_once('../Model/facturaModel.php');

    class facturasController{

        public static function ver_traer_FacturaID($id){
            try {
                return empleadoModel::traerfacturasid($id);
                
            } catch (Exception $e) {   
                echo "Error: ". $e->getMessage();
            }
        }

        public static function ver_traer_Facturas(){
            try {
                return facturasModel::traerFacturas();
                
            } catch (\Exception $e) {   
                echo "Error: ". $e->getMessage();
            }
        }

        public static function insertar_Facturas($data){
            try {
                return facturasModel::insertarFacturas($data);
                
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        public static function eliminar_Facturas($id){
            try {
                return facturasModel::eliminarFacturas($id);
                
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        
        public static function modificarEmpleados($data){
            try {
                return facturasModel::modificarEmpleados($data);
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }
    }

?>