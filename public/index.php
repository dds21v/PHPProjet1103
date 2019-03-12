<?php
use Generic\App;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;

// chargement de l'autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';
// création requête
$request = ServerRequest::fromGlobals();
// création de la réponse
$app = new App();
$response = $app->handle($request);

// renvoi de la réponse au navigateur
\Http\Response\send($response);
// echo "hello";
