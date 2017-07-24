<?php

//namespace Framework\Generator;

class Make {

    // Command Line
    private $Filetype;
    private $Filename;
    private $Flags;

    // Paths
    private $Paths;

    // Result
    private $Destination;
    private $Template;
    private $Content;


    function __construct($type, $name, array $flags, $paths){
        $this->Filetype = $type;
        $this->Filename = $name;
        $this->Flags = $flags;
        $this->Paths = $paths;

        $this->checkCmdParam();
    }

    // Create and Write
    private function making(){
    }

    // Check if the setted param, exists in setting file
    private function checkCmdParam(){

        $_func = strtolower(__CLASS__);
        $_type = strtolower($this->Filetype);
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

    // Check the directorie for where this type will, when created.
    public function checkTargetDir(){
        // type with first charin uppercase 'Controller'
        $_type = ucfirst(strtolower($this->Filetype));
        $_paths = $this->Paths;
        $_type_dir = isset($_paths["App"][$_type]) ? dirname(__FILE__, 4).$_paths["App"][$_type] : null;
        if(  array_key_exists($_type, (array)$_paths["App"]) ){
            if( is_dir( $_type_dir )  ){
                $this->Destination = $_paths["App"][$_type] . $this->Filename . $_type;
                $this->checkTmpDir();
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

    // Check if the template of this filetype exists
    private function checkTmpDir(){

        $_type = strtolower($this->Filetype);
        $_paths = $this->Paths;
        $_template = dirname(__FILE__, 4).$_paths["Tmp"] . $_type;

        if( file_exists($_template) ){
            $this->Template = file_get_contents($_template);
            $this->replacement($this->Template);
        }else{
            echo "Nao existe um template para arquivos do tipo {$_type}.\n";
            echo "Crie um template para ele no diretorio: {$_template}\n";
            echo "Especificamente com o nome: {$_type} e sem extensao. \n";
            die;
        }
    }

    // Replace Variables from template and return new content
    private function replacement($content){
        $_type = strtolower( $this->Filetype );
        $_paths = $this->Paths;
        if( array_key_exists( $_type ,$_paths["Cmd"]["CMD_REPLACE"] ) ){
            $contet = str_replace( $_paths["Cmd"]["CMD_REPLACE"][$_type]["tag"] ,  $_paths["Cmd"]["CMD_REPLACE"][$_type]["replace"] , $content );
        }
        die($content);
    }

}
