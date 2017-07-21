<?php

namespace Framework;


class Route extends Core {
    private static $Url;
    private static $Controller;
    private static $Action;
    protected static $Closure;

    public static function get($url, $closure, $middleware = null){
        //Define Url
        self::$Url = $url;
        if(self::isClosure($closure)){
            // Resolve closure
            self::$Controller = $closure;
        }else{ 
            // Resolve closure
            self::$Closure = self::separateCtrlFromAct($closure);

            // Define the controller
            self::$Controller = self::$Closure['controller'];
            // Define the action
            self::$Action = self::$Closure['action']; 
        }

        // Build the route
        parent::$Routes[] = [
            'Request Method' => __FUNCTION__,
            'url' => self::$Url,
            'controller' => isset(self::$Controller) ? self::$Controller : null,
            'action' => isset(self::$Action) ? self::$Action : null
            ];
    }

    public static function post($url, $closure, $middleware = null){
        //Define Url
        self::$Url = $url;
        if(self::isClosure($closure)){
            // Resolve closure
            self::$Controller = $closure;
        }else{ 
            // Resolve closure
            self::$Closure = self::separateCtrlFromAct($closure);

            // Define the controller
            self::$Controller = self::$Closure['controller'];
            // Define the action
            self::$Action = self::$Closure['action']; 
        }

        // Build the route
        parent::$Routes[] = [
            'Request Method' => __FUNCTION__,
            'url' => self::$Url,
            'controller' => isset(self::$Controller) ? self::$Controller : null,
            'action' => isset(self::$Action) ? self::$Action : null
            ];
    }

    public static function patch($url, $closure, $middleware = null){
        //Define Url
        self::$Url = $url;
        if(self::isClosure($closure)){
            // Resolve closure
            self::$Controller = $closure;
        }else{ 
            // Resolve closure
            self::$Closure = self::separateCtrlFromAct($closure);

            // Define the controller
            self::$Controller = self::$Closure['controller'];
            // Define the action
            self::$Action = self::$Closure['action']; 
        }

        // Build the route
        parent::$Routes[] = [
            'Request Method' => __FUNCTION__,
            'url' => self::$Url,
            'controller' => isset(self::$Controller) ? self::$Controller : null,
            'action' => isset(self::$Action) ? self::$Action : null
            ];
    }

    public static function put($url, $closure, $middleware = null){
        //Define Url
        self::$Url = $url;
        if(self::isClosure($closure)){
            // Resolve closure
            self::$Controller = $closure;
        }else{ 
            // Resolve closure
            self::$Closure = self::separateCtrlFromAct($closure);

            // Define the controller
            self::$Controller = self::$Closure['controller'];
            // Define the action
            self::$Action = self::$Closure['action']; 
        }

        // Build the route
        parent::$Routes[] = [
            'Request Method' => __FUNCTION__,
            'url' => self::$Url,
            'controller' => isset(self::$Controller) ? self::$Controller : null,
            'action' => isset(self::$Action) ? self::$Action : null
            ];
    }

    public static function delete($url, $closure, $middleware = null){
        //Define Url
        self::$Url = $url;
        if(self::isClosure($closure)){
            // Resolve closure
            self::$Controller = $closure;
        }else{ 
            // Resolve closure
            self::$Closure = self::separateCtrlFromAct($closure);

            // Define the controller
            self::$Controller = self::$Closure['controller'];
            // Define the action
            self::$Action = self::$Closure['action']; 
        }

        // Build the route
        parent::$Routes[] = [
            'Request Method' => __FUNCTION__,
            'url' => self::$Url,
            'controller' => isset(self::$Controller) ? self::$Controller : null,
            'action' => isset(self::$Action) ? self::$Action : null
            ];
    }

    private static function separateCtrlFromAct($string){
        $parts = explode('@', $string);
        if(is_array($parts)){
            return (array)['controller' => $parts[0], 'action' => $parts[1]];
        }else{
            return 'Closure';
        }
    }

    private static function isClosure($param){
        if(is_object($param)){
            return true;
        }else{
            return false;
        }
    }
}

