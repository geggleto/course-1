<?php


namespace Tests\MyApp;


use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\RequestBody;
use Slim\Http\UploadedFile;
use Slim\Http\Uri;

class RequestFactory
{
    /**
     * @return Request
     */
    public static function make() {
        $env = Environment::mock();
        $uri = Uri::createFromString('https://example.com:443/foo/bar?abc=123');
        $headers = Headers::createFromEnvironment($env);
        $cookies = [
            'user' => 'john',
            'id' => '123',
        ];
        $serverParams = $env->all();
        $body = new RequestBody();
        $uploadedFiles = UploadedFile::createFromEnvironment($env);
        $request = new Request('GET', $uri, $headers, $cookies, $serverParams, $body, $uploadedFiles);

        return $request;
    }
}