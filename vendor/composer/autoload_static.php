<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit30b75ec5b117e149411766318a3f6993
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit30b75ec5b117e149411766318a3f6993::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit30b75ec5b117e149411766318a3f6993::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}