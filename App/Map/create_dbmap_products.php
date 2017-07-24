<?php

use DB\WPDataTable;
use DB\WPBlueprint;


class CreateDbmapProducts extends WPDataTable {

    public function upTable(){
        WPDataTable::run()->createTable('products', function(WPBlueprint $table){
            $table->int('id')->increments()->primaryKey();
            $table->varchar('user_name', 12);
            return $table;
        });
    }

    public function downTable(){
        $this->dropTable('products');
    }
    
}   
