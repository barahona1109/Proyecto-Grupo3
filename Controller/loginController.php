<?php
require_once('../Model/loginModel.php');

class loginController {


    public static function inicioSesion($data){

        //Try - Catch es para el manejo de errores
        try {

            $username = loginModel::validarUsuario($data);

            if(is_null($username[0]['Usuario'])){
                
                ?>
                 <script>
                    alert('Error al Iniciar Sesion. Debe completar el campo Nombre de Usuario.');
                    window.location.href = '../View/Index.php';
                 </script>
                <?php

            } else {

                session_start();
                $_SESSION['username'] = $username[0]['Usuario'];
                header('Location: ../View/home.php');

            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
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
