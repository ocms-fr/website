<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita11dd868bbf7312a05b99db7fb127fcd
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita11dd868bbf7312a05b99db7fb127fcd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita11dd868bbf7312a05b99db7fb127fcd::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
