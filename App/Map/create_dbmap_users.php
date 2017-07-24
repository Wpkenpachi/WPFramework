<?php

namespace DB; 

use DB\WPDataTable;
use DB\WPBlueprint;


class CreateDbmapUsers extends WPDataTable {

    public function upTable(){
        WPDataTable::run()->createTable('users', function(WPBlueprint $table){
            $table->int('id')->increments()->primaryKey();
            $table->varchar('user_name', 12);
            return $table;
        });
    }

    public function dropTable(){
        $this->dropTable('users');
    }
    
}   