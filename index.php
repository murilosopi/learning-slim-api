<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

// Middleware: camada de execução antes e depois do core da aplicação (neste caso, as rotas)

$app->add(function($request, $response, $next) {
    $response->write('Middleware 1 + ');
    // return $next($request, $response); # Apenas uma validação, seguida pela execução da rota

    $response = $next($request, $response); # Executa a rota

    return $response->write('+ Fim middleware 1');
});

/* O primeiro e último middleware a ser executado
$app->add(function($request, $response, $next) {
    $response->write('Middleware 2 + ');
    return $next($request, $response);
});
*/

$app->get('/usuarios', function($request, $response) {
    $response->write('Ação principal - <strong>Usuários</strong>: ');
});

$app->get('/postagens', function($request, $response) {
    $response->write('Ação principal - <strong>Postagens</strong>: ');
});

$app->run();


?>