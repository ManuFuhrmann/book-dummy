<?php

use FastRoute\RouteCollector;

//composer packages
require __DIR__ . '/../vendor/autoload.php';


//dotenv
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . DIRECTORY_SEPARATOR . '..');
$dotenv->load();


//php-di
$container = require __DIR__ . '/../app/bootstrap.php';

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    //invoice
    $r->addRoute('GET', '/invoice/getData/{id}/', array(Manuel\Core\Controller\ControllerInvoice::class, 'getData'));
    $r->addRoute('GET', '/invoice/setInactive/{id}/', array(Manuel\Core\Controller\ControllerInvoice::class, 'setInactiveAction'));

    //invoiceTemplate
    $r->addRoute('GET', '/invoiceTemplate/getData/{id}/', array(Manuel\Core\Controller\ControllerInvoiceTemplate::class, 'getData'));
    $r->addRoute('GET', '/invoiceTemplate/setInactive/{id}/', array(Manuel\Core\Controller\ControllerInvoiceTemplate::class, 'setInactiveAction'));
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;

    case FastRoute\Dispatcher::FOUND:
        $controller = $route[1];
        $parameters = $route[2];

        // We could do $container->get($controller) but $container->call()
        // does that automatically
        echo $container->call($controller, $parameters);
        break;
}