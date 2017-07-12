<?php


namespace Tests\MyApp\Http;


use MyApp\Http\MyInvokableClass;
use Slim\Http\Response;
use Tests\MyApp\RequestFactory;

class MyInvokableClassTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testInvoke()
    {
        //First we need a request object
        $request = RequestFactory::make();

        //Now we need a response object
        $response = new Response();

        $invokable = new MyInvokableClass();

        $output = $invokable($request, $response);

        //The stream has been written too; we rewind so we can see what was written
        $output->getBody()->rewind();

        $body = $output->getBody()->getContents();

        $this->assertEquals('Invokables are cool!', $body);

    }

    public function tearDown()
    {
        parent::tearDown();
    }
}