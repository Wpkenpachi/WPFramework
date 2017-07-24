<?php

namespace App\Repository;
use App\Model\Model;

class businessRepository extends Repository {

    public function businessListing($get){
        $type = ucfirst(strtolower($get[2])); // [0] -> home, [1] -> list, [2] -> {type}
        //var_dump(['type' => $type, 'clients' => $body]);die();
        $body = Model::exec()->select('usuarios')->all();
        $data = ['type' => $type, 'clients' => $body];
        return $data;
    }
    
}