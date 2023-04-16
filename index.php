<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

// Tipos de respostas
$app->get('/header', function($request, $response) {
    $response->write('Retorno <strong>header</strong>');

    return $response->withHeader('allow', 'PUT')
                    ->withAddedHeader('Content-Length', 30);
});

$app->get('/json', function($request, $response) {
    $usuario = ['email' => 'user@gmail.com', 'senha' => 'user123'];
    return $response->withJson($usuario);
});

$app->get('/xml', function($request, $response) {
    $xml = file_get_contents(__DIR__ . '/src/assets/produto.xml');
    $response->write($xml);

    return $response->withHeader('Content-Type', 'application/xml');
});

$app->run();


?>