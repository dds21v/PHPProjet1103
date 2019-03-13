<?php
use Generic\App;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Appli\Controller\HomeController;
use Generic\Middlewares\TrailingSlashMiddleware;

// chargement de l'autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';
// création requête
$request = ServerRequest::fromGlobals();
// création de la réponse
$app = new App([new TrailingSlashMiddleware(), new HomeController()]);
$response = $app->handle($request);

// renvoi de la réponse au navigateur
\Http\Response\send($response);
// echo "hello";
