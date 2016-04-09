<?php
// cli-config.php

require_once 'bootstrap.php';

$em = include BASEDIR . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . '/entity.manager.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;

return ConsoleRunner::createHelperSet($em);
