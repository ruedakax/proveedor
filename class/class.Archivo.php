<?php
    
    /**
     * Archvio
     *
     * Clase para la validación básica de archivos.
     *
     * @author Mauricio Rueda <ruedakax@gmail.com>     
     */
     
    class Archivo {
        
        public $fileArray;

        public $nit;

        public $fechaExpira;

        public $source;

        public $extension;
        //
        public $errors = array();

        /**
         * @var array $patterns
         */
        public $config = array(
            'max_size' => 6291456,
            'types' => array('image/jpeg','image/png','application/pdf'),
            'exts' => array('jpeg','jpg','png','pdf')
        );

        function __construct($input,$nit,$source,$fechaExpira){
            $this->fileArray = $input;
            $this->nit = $nit;
            $this->source = $source;            
            $this->fechaExpira = $fechaExpira;
        }       
        //
        public function checkSize(){            
            if($this->fileArray["size"] > $this->config['max_size']){
                $this->errors[] = array($this->source,'El archivo excede el tamaño permitido (6MB)');
            }
        }
        //
        public function checkType(){
            if(!in_array($this->fileArray["type"],$this->config['types'])){
                $this->errors[] = array($this->source,'El archivo no es del tipo permitido (.png, .jpeg, .pdf)');
            }
        }
        //
        public function checkExt(){
            $parts = explode('.',$this->fileArray["name"]);
            $ext = count($parts)===2?in_array($parts[1],$this->config['exts']):'';
            if(empty($ext)){
                $this->errors[] = array($this->source,'El archivo no tiene la extension permitida (.png, .jpeg, .pdf)');
            }else{
                $this->extension = $parts[1];
            }   
        }     
        //
        public function getErrors(){
            return $this->errors;
        }
        //        
        public function save($dir){
            $finalSource = $dir.$this->nit."/".$this->source.".".$this->extension;
            if(!@move_uploaded_file($this->fileArray["tmp_name"], $finalSource)){
                $this->errors[] = array($this->source,'El archivo no pudo ser guardado');
            }
        }
        //
        public function validate($dirPrincipal){
            $this->checkSize();
            $this->checkType();
            $this->checkExt();
            $this->save($dirPrincipal);
            return empty($this->errors);
        }
    }