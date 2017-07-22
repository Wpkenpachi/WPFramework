<?php

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
        $_type = $this->Filetype;
        $_paths = $this->Paths;
        if( in_array($_type, $_paths["Cmd"]["WP"][$_func]) || in_array($_type, $_paths["Cmd"]["USER"][$_func]) ){
            $this->checkTargetDir();
        }else{
            echo "O parametro setado para o comando ".__CLASS__." nao existe.\n";
            die;
        }
    }

    // Check the directorie for where this type will, when created.
    public function checkTargetDir(){
        
        $_type = ucfirst(strtolower($this->Filetype));
        $_paths = $this->Paths;
        if( array_key_exists($_type, $_paths["App"]) ){
            $this->Destination = $_paths["App"][$_type] . $this->Filename . $_type;
            $this->checkTmpDir();
        }else{
            echo "Nao existe um diretorio para arquivos do tipo {$_type}.\n";
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
        }else{
            echo "Nao existe um template para arquivos do tipo {$_type}.\n";
            die;
        }
    }

    // Replace Variables from template and return new content
    private function replacement(){

    }

}
