<?php

use MyApp\Http\MyController;
use Slim\Http\Request;
use \Slim\Http\Response;

include_once __DIR__ . "/../config/bootstrap.php";

$container = new Slim\Container(include __DIR__."/../config/container.php");

$app = new Slim\App($container);

//Simple Route!
$app->get('/', function (Request $request, Response $response) {
   return $response->write('Hello Student!!!!');
});


$app->get('/controller/myotheraction', [MyController::class, ":myaction"]);

//Catch All
$app->get('/controller/{action}', function (Request $request, Response $response, array $args) {
    /** @var $controller MyController */
    $controller = $this->get(MyController::class);
    return $controller->defaultAction($request, $response, $args);
});

//Let's use an Invokable Class!
$app->get('/invokable', \MyApp\Http\MyInvokableClass::class);

$app->run();