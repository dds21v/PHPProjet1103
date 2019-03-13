<?php
namespace Generic\Middlewares;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TrailingSlashMiddleware implements MiddlewareInterface 
{
    public function process (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface 
    {
        // Trouver l'url
        $url = $request->getUri()->getPath();
        // Déterminer le dernier caractère de l'url
        $lastCharacter = substr($url, -1);
        // Si le dernier caractère est un slash
        if ($lastCharacter === '/' && strlen($url) !== 1) 
            {
            // déterminer la nouvelle URL
            $newUrl = substr($url, 0, -1);
            var_dump($newUrl);
            // Rediriger
            $response = new Response(301, ['location'=>$newUrl]);
            return $response;
            }else{
            // Sinon on appelle le middleware suivant
            return $handler->handle($request);
            }
            


        // var_dump($url);
        die('On est dans TrailingSlash Middleware');
    }
}
