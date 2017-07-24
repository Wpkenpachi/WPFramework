<?php

namespace DB;

use DB\DBlueprint;

class WPDataTable {
    private static $Instance;
    private static $Conn;
    private static $DBlueprint;
    private $Query;
    private $QueryString;

    function __construct(){
        self::$Conn = new \PDO(DRIVER.":host=".HOST.";dbname=".DBNAME.";", USER, PASS);
        self::$Conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        self::$DBlueprint = new WPBlueprint;
    }

    public static function run(){
        if(is_null(self::$Instance)){
            self::$Instance = new self();
        }
        return self::$Instance;
    }

    // Check if the tables already exists!!
    public function checkTable($tableName = 'users'){
        $queryString = "SHOW TABLES LIKE '{$tableName}'";
        $query = self::$Conn->prepare($queryString);
        $query->execute();
        $tableExists = $query->rowCount();
        return $tableExists;
    }

    // Create a Table
    public function createTable(string $tableName, $closure){
            $tableName = trim($tableName);// Name of Table
            $checkTable = $this->checkTable($tableName);// Check if this table already exists
            if(!$checkTable){
                // Execute the closure, passing a WPBlueprint object
                $result = $closure(self::$DBlueprint)->returnAll();
                // Building the create table query
                $this->QueryString = 
                "CREATE TABLE {$tableName}(".
                implode("," ,array_values((array)$result['qstring'])).
                ( isset($result['index'])  ?  (','.implode("," ,array_values((array)$result['index'])).')')   : ')');
                $this->preparing();
            }else{
                echo "Table  '{$tableName}' already exists!\n";
            }
    }

    // Drop a Table
    public function dropTable(string $tableName){
            $checkTable = $this->checkTable($tableName);// Check if this table already exists
            if($checkTable){
                $this->QueryString = "DROP TABLE {$tableName}";
                $this->preparing();
            }else{
                echo "Table '{$tableName}' does not exists!\n";
            }
    }

    private function preparing(){
        $this->Query = self::$Conn->prepare($this->QueryString);
        $this->executing();
    }
    private function executing(){
        $this->Query->execute();
        $this->Done = $this->Query->rowCount();
    }
}