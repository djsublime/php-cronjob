<?php

class Logger
{
    private $_log;
    private $_path;

    function __construct() {

        $this->_log = array();
    }

    public function setPath($path){
        
        $this->_path = $path;

        if (!is_dir($this->_path)){

           mkdir($this->_path, 0777, true);
        }
    }

    public function add($line){

        $this->_log[] = '['.date('Y-m-d H:i:s').'] : '.$line;
    }

    public function write($file, $appendDate = true){

        if($appendDate){

            $info = pathinfo($this->_path.'/'.$file);

            $path = $info['dirname'].'/'.$info['filename'].'.'.strftime('%Y-%m-%d', time()).'.'.$info['extension'];

        }else{

            $path = $this->_path.'/'.$file;
        }


        if (($fh = @fopen($path, "a")) !== false){

            if (@fwrite($fh, implode("\n", $this->_log)) !== false){

                $this->_log = array();

                return true; 
            }

            fclose($fh); 
        }

        
        return false;

    }
}

