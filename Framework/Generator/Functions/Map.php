<?php

//namespace Framework\Generator\Functions;

class Map {

    // Command Line
    private $ParamType;
    private $Filename;

    // Paths
    private $Paths;

    // Listed maps
    private $Maps;


    function __construct($type, $name, array $flags, $paths){
        //$type, $name, array $flags, $paths
        $this->ParamType = $type;
        $this->Filename = $name;
        $this->Paths = $paths;

        $this->checkCmdParam();
    }

    // Check if the setted param, exists in setting file
    private function checkCmdParam(){

        $_func = strtolower(__CLASS__);
        $_type = strtolower($this->ParamType);
        $_paths = $this->Paths;
        if( in_array($_type, $_paths["Cmd"]["WP"][$_func]) ){
            $this->checkTargetDir();
        }else{
            echo "O parametro setado para o comando ".__CLASS__." nao existe.\n";
            echo "Para criar esse comando, va em '/Framework/Generator/commands.json' e crie assim: \n";
            echo "\"WP\": {\n";
            echo "\t \"meuComando\": [\"param1\",\"param2\", {...}],\n";
            echo "\t \"meusOutrosComandos\": [\"param1\",\"param2\", {...}]\n";
            echo " }\n";
            die;
        }
    }

    
    public function checkTargetDir(){
        
        $_type = ucfirst(strtolower(__CLASS__));
        $_paths = $this->Paths;
        $_type_dir = isset($_paths["App"][$_type]) ? dirname(__FILE__, 4).$_paths["App"][$_type] : null;
        $_all_maps = scandir($_type_dir);

        $_map_to_use = [];
        array_walk($_all_maps, function($map) use (&$_map_to_use){      
            if(pathinfo($map)['extension'] == 'php'){
                $_map_to_use[] = $map;
            }
        });
        //var_dump($_type_dir.$_map_to_use[0]);die();
        switch(strtolower($this->ParamType)){
            case 'up':
                $this->up($_type_dir, $_map_to_use);
                break;
            case 'down':
                $this->down($_type_dir, $_map_to_use);
                break;
        }
    }

    public function up($dir, $files = null){
        
        if(count($files) == 2){
            // Resolving Class Name
            $_class_name = explode('_',  pathinfo($files[0])['filename']  );
            array_walk($_class_name, function(&$c_name){
                $c_name = ucfirst(strtolower($c_name));
            });
            $_class_name = implode('', $_class_name);
            //===

            // Catching Classfile directorie
            include $dir.$files[0];
            // Instancing class
            $class = new $_class_name;
            $class->upTable();
        }elseif(count($files) > 1){
            foreach($files as $file):
                // Resolving Class Name
                $_class_name = explode('_',  pathinfo($files)['filename']  );
                array_walk($_class_name, function(&$c_name){
                    $c_name = ucfirst(strtolower($c_name));
                });
                $_class_name = implode('', $_class_name);
                //===

                // Catching Classfile directorie
                include $dir.$file;
                // Instancing class
                $class = new $_class_name;
                $class->upTable();
            endforeach;
        }
    }

    public function down($dir, $files = null){
        if(count($files) == 2){
            // Resolving Class Name
            $_class_name = explode('_',  pathinfo($files[0])['filename']  );
            array_walk($_class_name, function(&$c_name){
                $c_name = ucfirst(strtolower($c_name));
            });
            $_class_name = implode('', $_class_name);
            //===

            // Catching Classfile directorie
            include $dir.$files[0];
            // Instancing class
            $class = new $_class_name;
            $class->downTable();
        }elseif(count($files) > 1){
            foreach($files as $file):
                // Resolving Class Name
                $_class_name = explode('_',  pathinfo($files)['filename']  );
                array_walk($_class_name, function(&$c_name){
                    $c_name = ucfirst(strtolower($c_name));
                });
                $_class_name = implode('', $_class_name);
                //===

                // Catching Classfile directorie
                include $dir.$file;
                // Instancing class
                $class = new $_class_name;
                $class->downTable();
            endforeach;
        }
        
    }
}