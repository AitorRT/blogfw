<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit988cd4f4b84c8720ca8f14220838f960
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit988cd4f4b84c8720ca8f14220838f960::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit988cd4f4b84c8720ca8f14220838f960::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}