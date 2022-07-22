<?php
/**
 * The bootstrap file creates and returns the container.
 */

use DI\ContainerBuilder;

//simple DI
$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(__DIR__ . '/config.php');
$container = $containerBuilder->build();

return $container;