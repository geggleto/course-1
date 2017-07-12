<?php


namespace Tests\MyApp\Http;


use MyApp\Http\HomeAction;
use MyApp\Http\MyInvokableClass;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Tests\MyApp\RequestFactory;

class HomeActionTest extends \PHPUnit_Framework_TestCase
{
    /** @var ContainerInterface */
    protected $container;

    public function setUp()
    {
        parent::setUp();
        $this->container = new \Slim\Container(include __DIR__."/../../config/container.php");
    }

    public function testInvoke()
    {
        //First we need a request object
        $request = RequestFactory::make();

        //Now we need a response object
        $response = new Response();

        $invokable = $this->container->get(HomeAction::class);

        /** @var $output ResponseInterface */
        $output = $invokable($request, $response, []);

        //The stream has been written too; we rewind so we can see what was written
        $output->getBody()->rewind();

        $body = $output->getBody()->getContents();

        $this->assertTrue( (strpos($body, 'Bootstrap 101')!==false) );
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}