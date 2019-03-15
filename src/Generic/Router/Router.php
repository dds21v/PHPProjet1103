<?php

namespace Generic\Router;

use Zend\Expressive\Router\Route;
use Psr\Http\Server\MiddlewareInterface;
use Zend\Expressive\Router\FastRouteRouter;
use Psr\Http\Message\ServerRequestInterface;

class Router
{
    /**
     * @var FastRouteRouter
     */

    private $routerVendor;

    public function __construct()
    {
        $this->routerVendor= new FastRouteRouter();
    }
    
    /**
     * Ajoute une route dnas le routeur
     * @param string $url
     * @param MiddlewareInterface $controller
     * @param string|null $name - Nom unique de la route
     */

    public function addRoute(string $url, MiddlewareInterface $controller, ?string $name = null): void
    {
        // On crée un objet "Route" pour le passer au "vrai" routeur
        $route = new Route($url, $controller, null, $name);
        // On appelle la fonction du "vrai" routeur pour ajouter une route
        $this->routerVendor->addRoute($route);
    }

    /**
     * Ajoute une route dnas le routeur
     * @param ServerRequestInterface $request
     * @return null|MiddlewareInterface
     */
    public function match(ServerRequestInterface $request): ?MiddlewareInterface
    {
        // Récupération de l'URL
        // $url = $request->getUri()->getPath();<div class="">+</div>

        $result = $this->routerVendor->match($request);

        if ($result->isSuccess()) {
            // J'ai une route
            $route = $result->getMatchedRoute()->getMiddleware();
        } else {
            // j'ai pas de route => 404
            $route = null;
        }

        return $route;
    }
}
