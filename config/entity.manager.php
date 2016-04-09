<?php
// entity.manager.php
$paths = array(BASEDIR . '/module/Application/src/Application/Entity', /* add more as needed */ );

// external namespaces to reference
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$driver = new AnnotationDriver(new AnnotationReader(), $paths);
AnnotationRegistry::registerLoader('class_exists');

// NOTE: use "createXMLMetadataConfiguration()" for XML source
//       use "createYAMLMetadataConfiguration()" for YAML source
// NOTE: if the flag is set TRUE caching is done in memory
//       if set to FALSE, will try to use APC, Xcache, Memcache or Redis caching
//       see: http://docs.doctrine-project.org/en/latest/reference/advanced-configuration.html
$config   = Setup::createConfiguration(TRUE);

$config->setMetadataDriverImpl($driver);

$dbParams = include __DIR__ . '/database.params.php';

return EntityManager::create($dbParams, $config);
