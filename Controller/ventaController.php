<?php   

    require_once('../Model/ventaModel.php');

    class ventasController{

        public static function ver_traer_VentaID($id){
            try {
                return ventaModel::traerventasid($id);
                
            } catch (Exception $e) {   
                echo "Error: ". $e->getMessage();
            }
        }

        public static function ver_traer_Ventas(){
            try {
                return ventaModel::traerVentas();
                
            } catch (\Exception $e) {   
                echo "Error: ". $e->getMessage();
            }
        }

        public static function insertar_Venta($data){
            try {
                return ventaModel::insertarVenta($data);
                
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        public static function eliminar_Venta($id){
            try {
                return ventaModel::eliminarVenta($id);
                
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        
        public static function modificarVenta($data){
            try {
                return ventaModel::modificarVenta($data);
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }
    }

?>