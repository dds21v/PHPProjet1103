<?php 

namespace Generic;

use GuzzleHttp\Psr7\Response;
use Appli\Controller\HomeController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Generic\Middlewares\TrailingSlashMiddleware;

class App implements RequestHandlerInterface
{
    private $cptMiddleware;
    private $middlewares;

    public function __construct(array $middlewares)
    {
        // on initialise le compteur middleware
        $this->cptMiddleware = 0;

        $this->middlewares = $middlewares;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface 
    {
        // On récupère le middleware à appeller
        $middleware = $this->middlewares[$this->cptMiddleware];

        // incrémentation du compteur
        $this->cptMiddleware++;

        // On appelle le middleware
        $response = $middleware->process($request, $this);
        return $response;

        // Appel du premier middleware
        // $trailingSlash = new TrailingSlashMiddleware();
        // return $trailingSlash->process($request, $this);
        // Appel du second middleware
        // $controller = new HomeController();
        // return $controller->process($request, $this);
    }
}
