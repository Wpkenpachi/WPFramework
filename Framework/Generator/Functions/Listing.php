<?php

/**
* - First we have a param check. This param exists? (checkCmdParam)
* - Second if the param exists, we check if this param, have (checkTargetDir)
*   a directorie default setted to be listed.
* - Third get the list of files in this directorie and show it. (getListOfFiles)
*/

//namespace Framework\Generator\Functions;

class Listing {
    // Command Line
    private $Filetype;
    private $Filename;

    // Paths
    private $Paths;

    // Result
    private $Destination;
    private $ListOfFiles;


    function __construct(){
        // $type , $name , $flags = null, $paths  
        $this->Filetype = func_get_arg(0);
        $this->Filename = func_get_arg(1);
        $this->Paths = func_get_arg(3);

        $this->checkCmdParam();
    }

        // Check if the setted param, exists in setting file
    private function checkCmdParam(){

        $_func = strtolower(__CLASS__);
        $_type = $this->Filetype;
        $_paths = $this->Paths;
        if( array_key_exists($_func, $_paths["Cmd"]["WP"]) ){
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

    // Check the directorie where this type will be wanted.
    public function checkTargetDir(){
        
        $_type = ucfirst(strtolower($this->Filetype));
        $_paths = $this->Paths;
        $_type_dir = isset($_paths["App"][$_type]) ? dirname(__FILE__, 4).$_paths["App"][$_type] : null;
        if(  array_key_exists($_type, (array)$_paths["App"]) ){
            if( is_dir( $_type_dir )  ){
                $this->Destination = dirname(__FILE__, 4).str_replace('//', '/',$_paths["App"][$_type]);
                echo $this->Destination."\n";
                $this->getListOfFiles();
            }else{
                echo "Nao existe um diretorio  criado para arquivos do tipo {$_type}.\n";
                die;
            }
        }else{
            echo "Nao existe um diretorio setado para arquivos do tipo {$_type}.\n";
            echo "Para setar um diretorio, va no arquivo 'Paths.json' e crie:\n";
            echo "\"{$_type}\": \"//(directorie?)//(directorie?)//\", \n";
            die;
        }
    }

    private function getListOfFiles(){
        $this->ListOfFiles = scandir(substr_replace($this->Destination, "", -1));
        $_notEmpty = false;
        echo ":====== ". __CLASS__ .'-'.ucfirst(strtolower($this->Filetype)) . " ======:\n";
        array_walk($this->ListOfFiles,function($file) use (&$_notEmpty){
            if(pathinfo($file, PATHINFO_EXTENSION) == 'php'){
                $_notEmpty = true;
                echo "\x20".pathinfo($file)['filename']."\n";
            }
        });
        if(!$_notEmpty){
            echo "(empty)\n";
        }
        echo ":====================:\n";
    }
}