<?php

//namespace Framework;


class Render {

    private static $instance;
    protected $Paths;

    function __construct(){
        $paths_file = __DIR__ . '/../../Paths.json';
        $paths_contents = file_get_contents($paths_file);
        $this->Paths = json_decode($paths_contents, true);
    }

    public static function run(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function view($name, $data = null, $path = null){
        // Verifica se foram enviados dados para a view
        // E extrai eles.
        if($data && is_array($data)):
            extract($data);
        endif;
        // Verifica se a view está no caminho padrão
        // Ou em um caminho setado pelo usuario
        if($path == null):
            include __DIR__ . '/../..' . $this->Paths['View'] . $name . '.php';
        else:
            foreach($this->Paths as $item => $value):
                if($path == $item){
                    include __DIR__ . '/../..' . $value . $name . '.php';
                    break;
                }
            endforeach;
        endif;
    }

    public static function template(){

    }

}
