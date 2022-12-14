<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticIniteb20e37ed7c6f2aa53921973f8cc68d1
{
    public static $prefixLengthsPsr4 = array (
        'k' => 
        array (
            'kirillbdev\\WCUkrShipping\\' => 25,
            'kirillbdev\\WCUSCore\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'kirillbdev\\WCUkrShipping\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'kirillbdev\\WCUSCore\\' => 
        array (
            0 => __DIR__ . '/..' . '/kirillbdev/wcus-core/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticIniteb20e37ed7c6f2aa53921973f8cc68d1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticIniteb20e37ed7c6f2aa53921973f8cc68d1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticIniteb20e37ed7c6f2aa53921973f8cc68d1::$classMap;

        }, null, ClassLoader::class);
    }
}
