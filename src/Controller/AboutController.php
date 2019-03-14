<?php
namespace Appli\Controller;

use Generic\Controller\Controller;
use GuzzleHttp\Psr7\Response;
use Appli\Controller\AboutController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AboutController extends Controller 
{
    public function process (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface 
    {
        return $this->render('about.twig');
    }
}