<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App;

// Padrão PSR7 e verbos HTTP

// SELECT
$app->get('/postagens', function(Request $request, Response $response) {
    // echo 'Listagem de postagens';

    $response->getBody()->write('Listagem de postagens');
    return $response;
});

$app->post('/usuarios/adiciona', function(Request $request, Response $response) {
    // Recupera post ($_POST)
    $post = $request->getParsedBody();
    $nome = $post['nome'];
    $email = $post['email'];

    /*
    INSERT INTO
    ...
    */

    $response->getBody()->write( 'Sucesso' );
    return $response;
});

$app->put('/usuarios/atualiza', function(Request $request, Response $response) {
    $body = $request->getParsedBody();
    $nome = $body['nome'];
    $email = $body['email'];
    $id = $body['id'];

    /*
    UPDATE
    ...
    */
    
    $response->getBody()->write( 'Sucesso ao atualizar: #' . $id );
    return $response;
});

$app->delete('/usuarios/exclui/{id}', function(Request $request, Response $response) {
    $id = $request->getAttribute('id');

    /*
    DELETE FROM
    ...
    */

    $response->getBody()->write( 'Sucesso ao excluir: #' . $id);
    return $response;
});



$app->run();


?>