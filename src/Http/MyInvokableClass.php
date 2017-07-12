<?php
/**
 * Created by PhpStorm.
 * User: glenn
 * Date: 7/11/2017
 * Time: 11:01 PM
 */

namespace MyApp\Http;


use Slim\Http\Request;
use Slim\Http\Response;

class MyInvokableClass
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function __invoke(Request $request, Response $response)
    {
        return $response->write('Invokables are cool!');
    }
}