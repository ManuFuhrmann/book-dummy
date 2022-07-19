<?php

use function DI\create;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return array(
    // Request
    \Manuel\Core\Interfaces\IRequest::class => create(\Manuel\Domain\Request::class),

    // ResponseHtml
    \Manuel\Core\Interfaces\IResponse::class => create(\Manuel\Domain\ResponseHtmlInvoiceTemplate::class),

    // Repository
    \Manuel\Core\Interfaces\IRepository::class => function (\DI\Container $container) {
        $loader = new \Manuel\Infrastructure\RepositoryMemoryInvoiceTemplate($container->get(\Manuel\Infrastructure\ConnectionMemory::class));
        return $loader;
    },

    // Connection
    \Manuel\Core\Interfaces\IConnection::class => function (\DI\Container $container) {
        $loader = new \Manuel\Infrastructure\ConnectionMemory($container->get(\Manuel\Core\Interfaces\IRepository::class));
        return $loader;
    },

    // ControllerInvoice
    \Manuel\Core\Controller\ControllerInvoice::class => function (\DI\Container $container) {
        $loader = new \Manuel\Core\Controller\ControllerInvoice($container->get(\Manuel\Core\Interfaces\IRepository::class));
        return $loader;
    },

    // ControllerInvoiceTemplate
    \Manuel\Core\Controller\ControllerInvoiceTemplate::class => function (\DI\Container $container) {
        $loader = new \Manuel\Core\Controller\ControllerInvoiceTemplate(
            $container->get(\Manuel\Infrastructure\RepositoryMemoryInvoiceTemplate::class),
            $container->get(\Manuel\Domain\ResponseHtmlInvoiceTemplate::class)
        );
        return $loader;
    },

    //create(\Manuel\Core\Controller\ControllerInvoiceTemplate::class),
);