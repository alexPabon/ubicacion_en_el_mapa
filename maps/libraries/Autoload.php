<?php
function load($clase){
    // variable Global
    global $directorios;
    
    // para cada directorio de la lista config.php
    foreach($directorios as $directorio){
        $ruta = "../../maps/$directorio/$clase.php";
        
        // si existe el fichero y es legible, cargalo!
        if(is_readable($ruta)){            
			require_once($ruta);
			break;
        }        
    }
}
    // Registrar las funciones dadas como implementación de __autoload()
spl_autoload_register("load");


