<?php
//bootstrap.php

define('BASEDIR', dirname(dirname(__FILE__)));

// Define runtime mode - 'development' or 'production'
define('APP_ENV', 'development');

// doctrine_autoloader.php
// returns an instance of Composer\Autoload\ClassLoader
$autoLoader = include BASEDIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// configure autoloader using add(prefix, path)
$autoLoader->add('Doctrine\Annotations', __DIR__ . '/vendor/doctrine/annotations/lib');
$autoLoader->add('Doctrine\Cache',       __DIR__ . '/vendor/doctrine/cache/lib');
$autoLoader->add('Doctrine\Collections', __DIR__ . '/vendor/doctrine/collections/lib');
$autoLoader->add('Doctrine\Common',      __DIR__ . '/vendor/doctrine/common/lib');
$autoLoader->add('Doctrine\DBAL',        __DIR__ . '/vendor/doctrine/dbal/lib');
$autoLoader->add('Doctrine\ORM',         __DIR__ . '/vendor/doctrine/orm/lib');
$autoLoader->add('Doctrine\Lexer',       __DIR__ . '/vendor/doctrine/lexer/lib');

// add path info for the "Application" namespace
$autoLoader->add('Application', BASEDIR . DIRECTORY_SEPARATOR . 'module' . DIRECTORY_SEPARATOR . 'Application' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Application');
