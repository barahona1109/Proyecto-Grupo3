<?php
require_once('conexionModel.php');

class usuarioModel {

    public static function crearUsuario($usuario, $password, $id_cargo) {
        $sql = "CALL crear_usuario(?, ?, ?)";
        $params = array($usuario, $password, $id_cargo);
        conexionModel::execute($sql, $params);
    }

    public static function obtenerTodosLosUsuarios() {
        $sql = "CALL obtener_todos_los_usuarios()";
        return conexionModel::get_data($sql);
    }

    public static function obtenerUsuarioPorId($id) {
        $sql = "CALL obtener_usuario_por_id(?)";
        $params = array($id);
        $result = conexionModel::get_data($sql, $params);
        return $result ? $result[0] : null;  // Retornar el primer resultado o null si no existe
    }
    public static function actualizarUsuario($id, $usuario, $password, $id_cargo) {
        $sql = "CALL actualizar_usuario(?, ?, ?, ?)";
        $params = array($id, $usuario, $password, $id_cargo);
        conexionModel::execute($sql, $params);
    }

    public static function eliminarUsuario($id) {
        $sql = "CALL eliminar_usuario(?)";
        $params = array($id);
        conexionModel::execute($sql, $params);
    }

    public static function editarUsuario($id, $usuario, $password, $id_cargo) {
        $sql = "CALL editar_usuario(?, ?, ?, ?)";
        $params = [$id, $usuario, $password, $id_cargo];
        return conexionModel::execute($sql, $params);
    }
}
?>
