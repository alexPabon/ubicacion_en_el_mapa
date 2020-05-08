<?php
// Realiza la consulta a la base de datos BDD
// PDO proporciona una capa de abstracción de
// acceso a datos, lo que significa que, independientemente 
// de la base de datos que se esté utilizando, se emplean las mismas
// funciones para realizar consultas y obtener datos.
class DB{
    // PROPIEDADES
    private static $conexion = null;

    // METODOS
        // Metodos que conecta/recupera la conexion con la base de datdos BDD
    public static function get():PDO{
        if(!self::$conexion){       //Si no estamos conectados...
            $dsn = SGDB.':host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET;

                // conecta con la BDD, sino lanzará un PDOException
            self::$conexion = new PDO($dsn,DB_USER,DB_PASS);
        }

        return self::$conexion;
    }

        // Metodo para realizar consultas SELECT de una fila
    public static function select(string $consulta, string $class='stdClass'){
        $outcome = self::get()-> query($consulta);
        return $outcome->rowCount()? $outcome->fetchObject($class) : null;
    }

        // Metodo para consultas SELECT de multiples filas
    public static function selectAll(string $consulta, string $class='stdClass'):array{
        $outcome = self::get()->query($consulta);
        $object = [];

        while($r=$outcome->fetchObject($class))
            $object[] = $r;

        return $object;
    }

        // Metodo para INSERT, retorna un valor autonumerico o FALSE en caso de Error
    public static function insert(string $consulta){
        if(!self::get()->query($consulta)) return false;

        return self::get()->query($consulta);
    }

        // Metodo para UPDATE, retorna el numero de filas afectadas o FALSE en caso de Error
    public static function update(string $consulta){
        $outcome = self::get()->query($consulta);

        return $outcome? $outcome->rowCount() : false;
    }

        // metodo para DELETE, retorna el numero de filas afectadas o FALSE en caso de Error
    public static function delete(string $consulta){
        $outcome = self::get()->query($consulta);

        return $outcome? $outcome->rowCount() : false;
    }
}