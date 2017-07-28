<?php 

namespace Framework;

trait Request {

    protected static $Attrs;
    protected static $Body;


    public static function getAttr($attr){
        return isset(self::$Attrs[$attr]) 
        ? self::$Attrs[$attr]
        : null;
    }

    public static function getAttrs(){
        return isset(self::$Attrs) 
        ? self::$Attrs
        : null;
    }

    public static function getBody(){
        return isset(self::$Body)
        ? self::$Body
        :null;
    }

}