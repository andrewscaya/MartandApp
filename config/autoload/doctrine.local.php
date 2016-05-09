<?php
/**
 * Local Configuration Override
 *
 */
return array(
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../../module/Application/src/Application/Entity',
	            ),
            ),

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Application' => 'my_annotation_driver'
                )
            ),
        ),
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'driver'         => 'pdo_mysql',
                    'host'           => 'localhost',
                    'dbname'         => 'test',
                    'user'           => 'testuser',
                    'password'       => 'password',
                    'driver_options' => array(
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                        // NOTE: change to PDO::ERRMODE_SILENT for production!
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ),
                )
            )
        ),
        // Use array cache locally, also auto generate proxies on development environment.
        'configuration' => array(
            'orm_default' => array(
                'metadata_cache' => 'array',
                'query_cache' => 'array',
                'result_cache' => 'array',
                'hydration_cache' => 'array',
                'generate_proxies' => true,
            ),
        ),
        // Entity Manager instantiation settings
        'entitymanager' => array(
            'orm_default' => array(
                'connection'    => 'orm_default',
                'configuration' => 'orm_default',
            ),
        ),
    )
);
