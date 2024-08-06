<?php 

class conexionModel {

    /*
    Funcion que me permite realizar insercciones a mi BD
    */

    public static function execute($scritpSQL) {
        try {
            
            //Cadena de Conexión a la BD
            $conexion = mysqli_connect(
                'localhost',
                'root',
                '',
                'luce'
            ) or die ('No se puede conectar a la DB');

            //Ejecución de Scripts a la BD
            $script = mysqli_query($conexion,$scritpSQL);
            
            $resultado = array(
                'exito' => $script,
                'error' => mysqli_error($conexion),
                'conexion' => $conexion
            );

            return $resultado;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function get_data($scritpSQL) {
        try {
            
            $resultado = self::execute($scritpSQL);
            $filas = array();

            if ($resultado['exito']) {

                while($fila = mysqli_fetch_array($resultado['exito'], MYSQLI_ASSOC)) {
                    $filas[] = $fila;
                }

                self::desconectar($resultado['conexion'], $resultado['exito']);

            }

            return $filas;

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
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