<?php
namespace Appli\Controller;

use Generic\Controller\Controller;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;

class HomeController extends Controller 
{
    public function process (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface 
    {
        $products = [
            [
                "id"=>1,
                "name"=>"Hamac",
                "description"=> "Pour se reposer"
            ],
            [
                "id"=>2,
                "name"=>"Parasol",
                "description"=> "Pour faire de l'ombre"
            ]

        ];
        return $this->render('home.twig', 
            [
            'products' => $products,
            'title' => "Bonjour!"
            ]);
    }
}
