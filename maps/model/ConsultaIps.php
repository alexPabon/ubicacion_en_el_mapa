<?php
// Modelo para realizar consultas en la tabla de consultasips en la BDD

class ConsultaIps{
    
    public static function getDistinct(){
        $consulta = "SELECT DISTINCT numeroIp FROM consultasips
                        ORDER BY numeroIp DESC";

        return DB::selectAll($consulta,'ConsultaIps');        
    }

    public static function getAll():array{
        $consulta = "SELECT numeroIp, created_at FROM consultasips
                        ORDER BY numeroIp DESC";

        return DB::selectAll($consulta,'ConsultaIps');        
    }
}