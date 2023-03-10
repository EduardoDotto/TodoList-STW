<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit8024ff6544c9e7e39998f4496b6d759d
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit8024ff6544c9e7e39998f4496b6d759d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit8024ff6544c9e7e39998f4496b6d759d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit8024ff6544c9e7e39998f4496b6d759d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
