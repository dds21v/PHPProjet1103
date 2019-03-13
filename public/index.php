<?php
use Generic\App;
// use GuzzleHttp\Psr7\Response;
use Generic\Router\Router;
use GuzzleHttp\Psr7\ServerRequest;
use Appli\Controller\HomeController;
use Generic\Router\RouterMiddleware;
use Appli\Controller\AboutController;
use Appli\Controller\ContactController;
use Generic\Middlewares\TrailingSlashMiddleware;

// chargement de l'autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';
// création requête
$request = ServerRequest::fromGlobals();

// Ajout des routes dans le routeur
$router = new Router();
$router->addRoute('/home', new HomeController(), 'Homepage');
$router->addRoute('/', new HomeController(), 'Homepage');
$router->addRoute('/contact', new ContactController(), 'Contact');
$router->addRoute('/about', new AboutController(), 'About');



// création de la réponse
$app = new App([new TrailingSlashMiddleware(), new RouterMiddleware($router)]);
$response = $app->handle($request);

// renvoi de la réponse au navigateur
\Http\Response\send($response);
// echo "hello";
