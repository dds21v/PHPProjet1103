<?php
use Generic\App;
// use GuzzleHttp\Psr7\Response;
use Generic\Router\Router;
use Generic\Renderer\TwigRenderer;
use GuzzleHttp\Psr7\ServerRequest;
use Appli\Controller\HomeController;
use Generic\Router\RouterMiddleware;
use Appli\Controller\AboutController;
use Appli\Controller\ContactController;
use Generic\Middlewares\TrailingSlashMiddleware;


$rootDir = dirname(__DIR__);
// chargement de l'autoloader
require_once $rootDir . '/vendor/autoload.php';

// création requête
$request = ServerRequest::fromGlobals();

// Initialiser TWIG
$twig = new TwigRenderer($rootDir . '/templates');

// Ajout des routes dans le routeur
$router = new Router();
$router->addRoute('/home', new HomeController($twig), 'Homepage');
$router->addRoute('/', new HomeController($twig), 'Homepage1');
$router->addRoute('/contact', new ContactController($twig), 'Contact');
$router->addRoute('/about', new AboutController($twig), 'About');



// création de la réponse
$app = new App([new TrailingSlashMiddleware(), new RouterMiddleware($router)]);
$response = $app->handle($request);

// renvoi de la réponse au navigateur
\Http\Response\send($response);
// echo "hello";
