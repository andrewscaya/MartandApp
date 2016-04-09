<?php
// database.params.php

if (APP_ENV == 'development') {
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
    );
}
else {
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT
    );
}

return array(  
    'driver'         => 'pdo_mysql',
    'host'           => '127.0.0.1',
    'dbname'         => 'test',
    'user'           => 'testuser',
    'password'       => 'password',
    'driver_options' => $options
);
