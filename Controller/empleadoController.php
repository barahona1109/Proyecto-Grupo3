<?php   

    require_once('../Model/empleadoModel.php');

    class empleadoController{

        public static function ver_traer_EmpleadosID($id){
            try {
                return empleadoModel::traerEmpleadosid($id);
                
            } catch (Exception $e) {   
                echo "Error: ". $e->getMessage();
            }
        }

        public static function ver_traer_Empleados(){
            try {
                return empleadoModel::traerEmpleados();
                
            } catch (\Exception $e) {   
                echo "Error: ". $e->getMessage();
            }
        }

        public static function insertar_Empleados($data){
            try {
                return empleadoModel::insertarEmpleados($data);
                
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        public static function eliminar_Empleados($id){
            try {
                return empleadoModel::eliminarEmpleados($id);
                
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }

        
        public static function modificarEmpleados($data){
            try {
                return empleadoModel::modificarEmpleados($data);
            } catch (Exception $e) {
                echo "Error: ". $e->getMessage();
            }
        }
    }

?>