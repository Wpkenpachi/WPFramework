<?php

namespace App\Controller;

use App\Controller\Controller;

class dashboardController extends Controller {

    public function index($get){
        echo "Estou no Controller da View Index do Dashboard!<br>";
        echo "Variavel de Url Nome: {$get[2]}<br>";
        echo "Variavel de Url idade: {$get[1]}<br>";
    }

}