<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\Model;
use Framework\Render;


class homeController extends Controller {


    public function index($get, $body){
        $model = Model::exec()
        ->select('usuarios', 'nome')
        ->where('id', '>', 0)
        ->orderBy('nome DESC');

        $user = $model->single();
        $trabalho = ['trabalho' => 'Empresa Dev', 'salario' => 1500];
        $user = array_merge($user , $trabalho);
        Render::run()->view('page1', ['user' => $user]);
    }

    public function validate($get, $body){
        echo "Controller de Validacao de Login";
        echo '<pre>';
        print_r($body);
        echo '</pre>';
    }
}