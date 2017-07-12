<?php


namespace MyApp\Http;


use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class HomeAction
{
    /**
     * @var Twig
     */
    private $twig;

    public function __construct(Twig $twig)
    {

        $this->twig = $twig;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        return $this->twig->render($response, "home.twig");
    }
}