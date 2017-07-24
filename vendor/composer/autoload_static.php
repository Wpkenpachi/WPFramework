<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit093084a1cfc5418ee4c96f1ecae7ed85
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Framework\\' => 10,
        ),
        'D' => 
        array (
            'DB\\' => 3,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Framework\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Framework',
        ),
        'DB\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Database',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
            1 => __DIR__ . '/../..' . '/Http',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit093084a1cfc5418ee4c96f1ecae7ed85::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit093084a1cfc5418ee4c96f1ecae7ed85::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
