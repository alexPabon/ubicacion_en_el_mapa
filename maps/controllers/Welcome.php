<?php
//Controlador por defecto

class Welcome{

    public static function index(){
                
        // carga la vista del mapa para poner todas la ubicaciones
        include '../../maps/views/locationMap.php';
    }    

}