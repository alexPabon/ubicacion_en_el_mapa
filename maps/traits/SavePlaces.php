<?php

trait SavePlaces{
    
    /**
     * Convierte el array en json y lo guarda en el fichero
     * where.js
     * @param array $datos
     * @return boolean
     */
    protected static function saveFile(array $datos):bool{
        $file = '../../public_html/public/js/where.js';
        $dataFilter = self::comprobarIps($datos);
        file_put_contents($file,'var queryData=[]');

        if(is_readable($file)){
            $json = json_encode($dataFilter);
            $save = 'var queryData ='.$json;
            $file = fopen($file,'w');            
            fwrite($file,$save);
            fclose($file);
            return true;
        }
        return false;
    }
    
    /**
     * Consulta si el numero de ip existe en el fichero cities.txt
     * self::checkIp
     * Abre el fichero y añade los nuevos datos
     * self::readFile
     * 
     * @param array $dato
     * @return boolean
     */
    protected static function saveCity(array $dato):bool{
        $existIp = self::checkIp($dato['query']);        
        $file = '../../maps/storage/cities.txt';
        $newFile = '';

        $contentSave['query']= $dato['query'];
        $contentSave['country']= $dato['country'];
        $contentSave['city']= $dato['city'];
        $contentSave['zip']= $dato['zip'];
        $contentSave['lat']= $dato['lat'];
        $contentSave['lon']= $dato['lon'];
        
        if(is_readable($file)){                       
            
            if(!$existIp){
                $contentFile = self::readFile();               
                $contentFile[]=$contentSave;
                
                foreach($contentFile as $value){
                    $json = json_encode($value);
                    $newFile .= $json.'!';
                }
                
                file_put_contents($file,$newFile);

                return true;
            }                                  
        }    
        return false;   
    }

     /**     
     * Abre el fichero y comprueba que exita la ip
     * self::readFile
     * 
     * @param string $ip
     * @return boolean
     */
    protected static function checkIp($ip):bool{
        $existIp = False;
        $contentFile = self::readFile();           

        foreach($contentFile as $content){                
            if($ip==$content->query){
                $existIp = true;
                break;
            }
        }
        return $existIp;
    }

     /**     
     * Abre el fichero y lo añade en un array     
     *      
     * @return array
     */
    protected static function readFile():array{
        $file = '../../maps/storage/cities.txt';
        $contentFile = [];
                
        if(is_readable($file)){
            $file = fopen($file,'r');
            $li ='';
            
            while($linea = fgets($file)){
                $li = preg_split('[!]',$linea);                
                foreach($li as $value)
                    if(!empty($value))
                        $contentFile[]= json_decode($value);
            }

            fclose($file);            
        }        
        return $contentFile;
    }

     /**     
     * lee el fichero cities.txt
     * self::readFile
     * 
     * recorre $datos y se extrae los datos de cities.txt
     * guardandolos en un array
     * 
     * @param array $datos     
     * @return array
     */
    protected static function comprobarIps(array $datos):array{
        $content =[];
        $readFile = self::readFile();
        foreach($datos as $dato){
            $ip = $dato->numeroIp;

            foreach($readFile as $value)
                if($ip==$value->query){
                    $content[] = $value;
                    break;
                }
        }
        
        return $content;
    }
}