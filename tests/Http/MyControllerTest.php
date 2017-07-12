<?php


namespace Tests\MyApp\Http;


use MyApp\Http\MyController;
use Slim\Http\Response;
use Tests\MyApp\RequestFactory;

class MyControllerTest extends \PHPUnit_Framework_TestCase
{
    /** @var MyController */
    protected $controller;

    /**
     * This is run before every test method
     */
    public function setUp()
    {
        parent::setUp();

        $this->controller = new MyController();
    }

    public function testMyAction() {
        //First we need a request object
        $request = RequestFactory::make();

        //Now we need a response object
        $response = new Response();

        //Now we test the method
        $output = $this->controller->myaction($request, $response);

        //The stream has been written too; we rewind so we can see what was written
        $output->getBody()->rewind();

        $body = $output->getBody()->getContents();

        $this->assertEquals('Controller Example!', $body);
    }

    public function testDefaultAction()
    {
        //First we need a request object
        $request = RequestFactory::make();

        //Now we need a response object
        $response = new Response();

        $randomMethod = bin2hex(random_bytes(8));

        //Now we test the method
        $output = $this->controller->defaultAction($request, $response, ['action' => $randomMethod]);

        //The stream has been written too; we rewind so we can see what was written
        $output->getBody()->rewind();

        $body = $output->getBody()->getContents();

        $this->assertEquals('Controller default Example! Method: ' . $randomMethod, $body);
    }

    /**
     * This is run after every test method
     */
    public function tearDown()
    {
        parent::tearDown();
    }
}