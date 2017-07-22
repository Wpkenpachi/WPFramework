<?php

require __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../App/config.php';

use Framework\Core;
use Framework\Route;

$app = new Core;

Route::get('root', function(){
    echo "<h1> Bem vindo a WPFramework</h1>";
});

Route::get('login', 'homeController@index');

Route::get('user', 'homeController@show');

Route::post('login', 'homeController@validate');

Route::post('teste/{nome}/{sobrenome}', function($get, $body){
    echo "Meu nome e {$get[1]} {$get[2]}. <br>";
    echo "E eu tenho {$body['idade']} anos de idade. <br>";
    echo "Minha profissao: {$body['profissao']}.";
});

$app->run();

