<?php
// CONTROLADOR FRONTAL
// todas la peticiones pasa por aquí y las distribuye a su respectivo controlador
class FrontController{

    public static function main(){
                
        try{
            //Gestion de peticiones(dispatcher)
            // recupera el controlador de la peticion y la primera letra la pone en mayuscula
            $c = empty($_GET['c'])?DEFAULT_CONTROLLER : ucfirst($_GET['c']);
                        
            // Recupera el metodo de la peticion
            $m = empty($_GET['m'])?DEFAULT_METHOD : $_GET['m'];
    
            // Recupera el parametro correspondiente
            $p = empty($_GET['p'])?'' : $_GET['p'];
    
            // Carga el Controller
            $controlador = new $c();
    
            // Comprobamos si existe el metodo
            if(!is_callable([$controlador,$m]))
                throw new Exception("No existe la operacion $m");
                
            // llama al metodo del controlador,
            // condicionando que si $p esta vacio o no, pasanado el parametro
            // empty($p)? $controlador->$m() : $controlador->$m($p);            
            $controlador->$m($p);
        } catch (Throwable $e) {
            //Recupera el msn del error $e
            $msn = $e->getMessage();
            
            // carga la vista del para mostrar el Error
            include '../../maps/views/error.php';
        }
    }    
}