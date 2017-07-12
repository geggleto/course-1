<?php
/**
 * Created by PhpStorm.
 * User: glenn
 * Date: 7/11/2017
 * Time: 11:10 PM
 */

namespace MyApp\Http;


use Slim\Http\Request;
use Slim\Http\Response;

class MyController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function myaction(Request $request, Response $response)
    {
        return $response->write('Controller Example!');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function defaultAction(Request $request, Response $response, $args)
    {
        return $response->write('Controller default Example! Method: ' . $args['action']);
    }
}