<?php
namespace Appli\Controller;

use GuzzleHttp\Psr7\Response;
use Generic\Database\Connection;
use Generic\Controller\Controller;
use Generic\Renderer\TwigRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CategoryController extends Controller
{

   
    private $connection;

    public function __construct(TwigRenderer $twig, Connection $connection)
    {
        parent::__construct($twig);
        $this->connection = $connection;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $category = $this->connection->query("SELECT * FROM category");
        return $this->render('category.twig', ['category' => $category, 'title' => "Category_list"]);
    }
}
