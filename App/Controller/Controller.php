<?php

namespace App\Controller;

use \Framework\Core;

class Controller extends Core{


    protected $Paths;

    function __construct(){
        $paths_file = __DIR__ . '/../../Paths.json';
        $paths_contents = file_get_contents($paths_file);
        $this->Paths = json_decode($paths_contents, true);
    }
}