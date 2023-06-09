<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticIniteb5158f04a49bcdf2447dc4f24a92037
{
    public static $files = array (
        'cfe4039aa2a78ca88e07dadb7b1c6126' => __DIR__ . '/../..' . '/config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Medoo\\' => 6,
            'MagnitCLUB\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Medoo\\' => 
        array (
            0 => __DIR__ . '/..' . '/catfan/medoo/src',
        ),
        'MagnitCLUB\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticIniteb5158f04a49bcdf2447dc4f24a92037::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticIniteb5158f04a49bcdf2447dc4f24a92037::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticIniteb5158f04a49bcdf2447dc4f24a92037::$classMap;

        }, null, ClassLoader::class);
    }
}
