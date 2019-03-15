<?php
use Generic\App;
// use GuzzleHttp\Psr7\Response;
use DI\ContainerBuilder;
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

// Création du conteneur
$builder = new DI\ContainerBuilder();
$builder->addDefinitions($rootDir . '/config/config.php');
$container = $builder->build();
// $container = $container->get(HomeController::class);


// création requête
$request = ServerRequest::fromGlobals();

// Initialiser TWIG
$twig = new TwigRenderer($rootDir . '/templates');

// Ajout des routes dans le routeur
$router = $container->get(Router::class);
$router->addRoute('/home', $container->get(HomeController::class), 'Homepage');
$router->addRoute('/', $container->get(HomeController::class), 'HomepageSlash');
$router->addRoute('/contact', $container->get(ContactController::class), 'Contact');
$router->addRoute('/about', $container->get(AboutController::class), 'About');



// création de la réponse
$app = new App([
    $container->get(TrailingSlashMiddleware::class),
    $container->get(RouterMiddleware::class),
]);
$response = $app->handle($request);

// renvoi de la réponse au navigateur
\Http\Response\send($response);
// echo "hello";
