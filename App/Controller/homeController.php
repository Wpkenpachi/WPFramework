<?php
namespace App\Controller;

use App\Controller\Controller;
use App\Model\Model;
use Framework\Render;
use App\Repository\homeRepository;


class homeController extends Controller {


    public function index($get, $body){
        $user = homeRepository::getUsers();
        $trabalho = ['trabalho' => 'Empresa Dev', 'salario' => 1500];
        $user = array_merge($user , $trabalho);
        Render::run()->view('page1', ['user' => $user]);
    }


    public function show($get, $body){
        $user = homeRepository::getUser(3);
        $trabalho = ['trabalho' => 'nothing', 'salario' => 0];
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