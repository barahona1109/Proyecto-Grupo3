<?php
require_once('../Model/usuarioModelcliente.php');

class usuarioControllercliente{



    public static function insertar_Usuario($data){
        try {
            return usuarioModelcliente::insertarUsuario($data);
        } catch (Exception $e) {
            echo "Error: ". $e->getMessage();
        }
    }


}
?>
