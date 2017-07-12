<?php

return [
    \MyApp\Http\MyInvokableClass::class => function (\Slim\Container $container)
    {
        return new \MyApp\Http\MyInvokableClass();
    }
];