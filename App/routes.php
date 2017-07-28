<?php
use Framework\Route;
use Framework\Request;

// Routes

Route::get('root', function(){
    echo "<h1> Bem vindo a WPFramework</h1>";// WHAT jdioSJASJID
});

Route::get('home/{t1}/{t2}', function(){
    echo "Meu nome: ".Route::getAttr(1)."<br>";
    echo "Minha idade: ".Route::getAttr(2)."<br>";
});

Route::post('test/{_1}/{_2}/{_3}/{_4}/{_5}', 'homeController@getting');

Route::post('home', function(){
    $body = Route::getBody();
    var_dump($body);
});

Route::get('home', function(){
    echo "get";
});