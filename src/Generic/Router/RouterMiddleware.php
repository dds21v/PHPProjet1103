<?php 
namespace Generic\Router;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouterMiddleware implements MiddlewareInterface
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * process
     * Appel du contrôleur lié à la route ou renvoi d'une erreur 404
     * @param  ServerRequestInterface $request
     * @param  RequestHandlerInterface $handler
     *
     * @return MiddlewareInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {   
        // Récupération du routeur
        $routeur = new Router();
        // Récupération de l'éventuel contrôleur
        $controller = $this->router->match($request);
         // s'il y a un contrôleur => on appele sa méthode "process"
        if(!is_null($controller))
        {
            $response = $controller->process($request, $handler);
        // S'il n'y a pas de contrôleur => on renvoit une page 404
        }else{
            $response = new Response(404, [], "<h2>Page Introuvable</h2>");
        }
        return $response;
    
    }
}