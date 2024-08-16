<?php
require_once('../Model/loginModel.php');

class loginController {


    public static function inicioSesion($data){

        try {
            loginModel::validarUsuario($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            
        }
    }

    public static function cierreSesion(){

        try {
            
            session_start();
            session_destroy();
            header('Location: ./Index.php');

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

    }

}
