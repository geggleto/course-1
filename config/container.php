<?php

use Psr\Container\ContainerInterface;

return [
    \MyApp\Http\MyInvokableClass::class => function (ContainerInterface $container)
    {
        return new \MyApp\Http\MyInvokableClass();
    },
    \MyApp\Http\MyController::class => function (ContainerInterface $container) {
        return new \MyApp\Http\MyController();
    },
    'template.path' => __DIR__."/../templates",
    'cacheFile' => false,
    \Slim\Views\Twig::class => function (ContainerInterface $container)
    {
        $view = new \Slim\Views\Twig($container->get('template.path'), [
            'cache' => $container->get('cacheFile')
        ]);

        // Instantiate and add Slim specific extension
        $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
        $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));

        return $view;
    },
    \MyApp\Http\HomeAction::class => function (ContainerInterface $container) {
        return new \MyApp\Http\HomeAction($container->get(\Slim\Views\Twig::class));
    }
];