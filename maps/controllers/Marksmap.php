<?php
// Controlador para obtener los puntos en el mapa

class Marksmap{
    
    use PointMap, SavePlaces;

    /**
    *llama a metodo protegido actualizar
    *
    *redirecciona al mapa
    *
    *@return vacio
    */
    public function index(){    
        $this->mapa();        
    }        

    /**
     * Muestra la vista de localizacion en el mapa
     */
    public function mapa(){
        include('../../maps/views/locationMap.php');
    }

    /**
     * Consulta la BDD
     * solicita las ips sin que se repita
     * solicita todas las ip
     * 
     * guarda los datos del fichero cities en un array
     * SavePlaces::readFile
     * 
     */
    public function list(){
        $distinticIp = ConsultaIps::getDistinct();
        $allips = ConsultaIps::getAll();
        $fileList = self::readFile();

            // para eliminar el cache y refresque los cambios.
        // header("Cache-Control: no-cache, must-revalidate");        

        include('../../maps/views/verlista.php');
    }

    /**
    *Solicita el listado de las ips
    *pide las cordenadas en cargarDatos($p)
    *envia los datos para ser guardados
    *
    *@return vacio
    */    
    public function actualizar(){
        $distinticIp = ConsultaIps::getDistinct();        
        self::cargarDatos($distinticIp);                       
        $guardarJS = self::saveFile($distinticIp);
        
        if(!$guardarJS)
            throw new Exception("Ocurrio un error al guardar los datos en el fichero");

        header('location: /');
    }

    /**
     * recorre el array para consultar en la API
     * SavePlaces::checkIp
     * 
     * Guarda la respuesta en cities.txt
     * SavePlaces::saveCity
     * 
     * @param Array $datos
     * 
     */
    protected static function cargarDatos(array $datos){
                       
        $contador = 0;
        
        foreach ($datos as $value) {
            if(!self::checkIp($value->numeroIp)){
                $coordinates = self::apiResponse($value->numeroIp);
                if(!empty($coordinates)){                
                    self::saveCity($coordinates);                    
                    $contador++;
                } 
                    // para no exeder el numero de consultas y se pueda producir error
                if($contador>45)
                    break;
            }
        }                
    }
}