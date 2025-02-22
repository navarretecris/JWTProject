<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0738adad060bec1531a8965809b64c62
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'Navarretecris\\LoginCcnr\\' => 24,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Navarretecris\\LoginCcnr\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0738adad060bec1531a8965809b64c62::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0738adad060bec1531a8965809b64c62::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0738adad060bec1531a8965809b64c62::$classMap;

        }, null, ClassLoader::class);
    }
}
