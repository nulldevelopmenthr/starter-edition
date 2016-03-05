<?php

use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

error_reporting(error_reporting() & ~E_USER_DEPRECATED);

/*
 * @var ClassLoader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);
if (class_exists('PHPUnit_Runner_Version')) {
    set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.'/../vendor/mockery/mockery/library/');
    require_once 'Mockery/Loader.php';
    $loader = new \Mockery\Loader();
    $loader->register();
}

return $loader;
