<?php
class conexionModel {

    public static function execute($query, $params = []) {
        try {
            $conexion = mysqli_connect(
                'localhost',
                'root',
                '',
                'tienda_luce2'
            ) or die('No se puede conectar a la DB');

            $stmt = $conexion->prepare($query);
            
            if ($params) {
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }
            
            $stmt->execute();
            
            $resultado = array(
                'exito' => $stmt->get_result(),
                'error' => $stmt->error,
                'conexion' => $conexion
            );

            return $resultado;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array('exito' => false, 'error' => $e->getMessage(), 'conexion' => null);
        }
    }

    public static function get_data($query, $params = []) {
        try {
            $resultado = self::execute($query, $params);
            $filas = array();

            if ($resultado['exito'] instanceof mysqli_result) {
                while ($fila = mysqli_fetch_array($resultado['exito'], MYSQLI_ASSOC)) {
                    $filas[] = $fila;
                }
            } else {
                echo "Error en la consulta: " . $resultado['error'];
            }

            self::desconectar($resultado['conexion'], $resultado['exito']);

            return $filas;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return array(); 
        }
    }

    public static function desconectar($conexion, $resultado){
        try {
            if ($resultado instanceof mysqli_result) {
                mysqli_free_result($resultado);
            }
            mysqli_close($conexion);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
