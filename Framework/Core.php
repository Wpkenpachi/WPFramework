<?php

namespace Framework;

use Framework\Routing\Router;

class Core {

    use Request;

    protected $Paths;

    protected static $Routes;
    protected static $Request;
    protected $CurrentRoute;

    function __construct(){
        $paths_file = __DIR__ . '/../Paths.json';
        $paths_contents = file_get_contents($paths_file);
        $this->Paths = json_decode($paths_contents, true);
    }

    public function run(){
        $routing = new Router(self::$Routes);
        $this->CurrentRoute = $routing->run();
        
        if(is_object($this->CurrentRoute['controller'])){
            
            $this->executeClosure($this->CurrentRoute['controller']);

        }else{
            
            $this->callController($this->CurrentRoute['controller'],
                                  $this->CurrentRoute['action']
            );
        }
        
    }

    public function executeClosure($closure){
        self::$Attrs = (array)$this->CurrentRoute['get'];
        self::$Body = (array)$this->CurrentRoute['body'];
        call_user_func_array($closure, []);
    }

    public function callController($ctrl, $act){
        self::$Attrs = (array)$this->CurrentRoute['get'];
        self::$Body = (array)$this->CurrentRoute['body'];
        $ControllerName = "\App\\Controller\\" . $ctrl;
        $ControllerObject = new $ControllerName();
        call_user_func_array(array($ControllerObject, $act),[]);
    }

    public function routes(){
        echo '<pre>';
        print_r(self::$Routes);
        echo '</pre>';
    }
}