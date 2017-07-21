<?php

namespace Framework;

use Framework\Routing\Route;

class Core {

    protected $Paths;

    protected static $Routes;
    protected $Request;
    protected $CurrentRoute;

    function __construct(){
        $paths_file = __DIR__ . '/../../Paths.json';
        $paths_contents = file_get_contents($paths_file);
        $this->Paths = json_decode($paths_contents, true);
    }

    public function run(){
        $routing = new Route(self::$Routes);
        $this->CurrentRoute = $routing->run();
        if(is_object($this->CurrentRoute['controller'])){
            $this->executeClosure($this->CurrentRoute['controller'],
                                  $this->CurrentRoute['get'],
                                  $this->CurrentRoute['body']
                                  );
        }else{
            $this->callController($this->CurrentRoute['controller'],
                                  $this->CurrentRoute['action'],
                                  $this->CurrentRoute['get'],
                                  $this->CurrentRoute['body']
                                  );
        }
        
    }

    public function executeClosure($closure, $requestGet, $requestBody){
        call_user_func_array($closure,
            array($requestGet, $requestBody));
    }

    public function callController($ctrl, $act, $requestGet, $requestBody){
        $ControllerName = "\App\\Controller\\" . $ctrl;
        $ControllerObject = new $ControllerName();
        call_user_func_array(
            array($ControllerObject, $act),
            array($requestGet, $requestBody));
    }

    public function routes(){
        echo '<pre>';
        print_r(self::$Routes);
        echo '</pre>';
    }
}