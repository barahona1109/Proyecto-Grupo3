<?php
require_once('../Model/usuarioModel.php');

class usuarioController{

    public static function ver_traer_UsuariosID($id){
        try {
            return usuarioModel::traerUsuarioPorID($id);
        } catch (Exception $e) {   
            echo "Error: ". $e->getMessage();
        }
    }

    public static function ver_traer_Usuarios(){
        try {
            return usuarioModel::traerUsuarios();
        } catch (\Exception $e) {   
            echo "Error: ". $e->getMessage();
        }
    }

    public static function insertar_Usuario($data){
        try {
            return usuarioModel::insertarUsuario($data);
        } catch (Exception $e) {
            echo "Error: ". $e->getMessage();
        }
    }

    public static function eliminar_Usuario($id){
        try {
            return usuarioModel::eliminarUsuario($id);
        } catch (Exception $e) {
            echo "Error: ". $e->getMessage();
        }
    }

    public static function modificarUsuario($data){
        try {
            return usuarioModel::modificarUsuario($data);
        } catch (Exception $e) {
            echo "Error: ". $e->getMessage();
        }
    }
}
?>
