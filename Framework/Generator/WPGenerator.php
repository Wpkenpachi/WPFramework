<?php

class WPGenarator {

    // Instance
    private static $instance;

    // Paths
    protected $AppPath;
    protected $CmdsPath;
    protected $UserCmdPath;
    protected $TmpPath;

    // Command Line
    private $Func;
    private $Param;
    private $Name;
    private $Flags;

    function __construct($func, $param, $name, array $flags){
        // Paths of the Directories of the application
        $this->AppPath = $this->resolveJson(dirname(__FILE__, 3).'/Paths.json');

        // Path of the commands of wp
        $this->CmdsPath = $this->resolveJson(dirname(__FILE__, 1).'/commands.json');

        // Path of the custom commands of wp
        $this->UserCmdPath = $this->resolveJson(dirname(__FILE__, 1).'/Custom/customCmd.json');

        // Path of File Templates
        $this->TmpPath = $this->AppPath["Tmp"];


        // Command Line parameters
        $this->Func = $func;
        $this->Param = $param;
        $this->Name = $name;
        $this->Flags = $flags;
    }

    public static function cmd($func, $param, $name, array $flags){
        if(is_null(self::$instance)){
            self::$instance = new self($func, $param, $name, $flags);
        }
        return self::$instance;
    }

    private function resolveJson($path){
        $contents = json_decode(file_get_contents($path), true);

        return $contents;
    }
   
   public function run(){
        $_func = strtolower($this->Func);
        if( array_key_exists($_func, $this->CmdsPath["WP"]) || array_key_exists($_func, $this->CmdsPath["USER"]) ){
            $_func = ucfirst(strtolower($this->Func));
            $paths = array_merge([],['App' => $this->AppPath], ['Cmd' =>$this->CmdsPath], ['Ucmd' => $this->UserCmdPath], ['Tmp' => $this->TmpPath]);
            $class = new $_func($this->Param, $this->Name, (array)$this->Flags, $paths);    
        }else{
            echo "Esse comando nao foi encontrado.\n";
            die;
        }
   }
}

/*
make:controller  @name @flag1 @flag2
    :repository
    :view
    :template
list:controllers @name @flag1 @flag2
    :repositorys
    :views
    :templates
    :routes
    :dbmaps
dbmap:up         @flag1[@name]
     :down
*/


