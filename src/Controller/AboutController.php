<?php
namespace Appli\Controller;

use GuzzleHttp\Psr7\Response;
use Appli\Controller\AboutController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AboutController implements MiddlewareInterface
{
    public function process (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface 
    {
        return new Response(200, [], '<h1>Bonjour Depuis AboutController</h1>');
    }
}