<?php

namespace App\Repository;
use App\Model\Model;

class homeRepository extends Repository {

    public static function getUsers(){
        $model = Model::exec()
        ->select('usuarios', 'nome')
        ->where('id', '>', 0)
        ->orderBy('nome DESC');
        $user = $model->single();
        return $user;
    }

    public static function getUser($param){
        if(is_array($param)){
            $field = array_keys($param, 0);
            $value = $param[$field[0]];
            $model = Model::exec()
            ->select('usuarios', '*')
            ->where("{$field[0]}", "{$value}")
            ->single();

            return $model;
        }else{
            $model = Model::exec()
            ->select('usuarios', '*')
            ->where("id", $param)
            ->single();

            return $model;
        }
    }
}