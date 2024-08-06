<?php 
    require_once('../Model/conexionModel.php');

    class loginModel {

        public static function validarUsuario($data) {
            try {
                
                $sql = "'" . $data['username'] . "'" . ",'" . $data['clave'] . "'"; //'usuario', 'contraseña'
                $resultado = conexionModel::get_data("call pr_get_validarUsuario($sql);");

                return $resultado;

            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

    }

?>