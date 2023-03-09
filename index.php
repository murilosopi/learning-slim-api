<?php

require 'vendor/autoload.php';

$app = new \Slim\App;

// Criação de uma rota
$app->get('/postagens2', function() {
    echo 'Listagem de postagens';
});

// Rota utilizando placeholder e Regex
// [] -> Atributo opcional

$app->get('/usuarios[/{id:[0-9]*}]', function($Request, $Response) {
    $id = $Request->getAttribute('id');
    echo 'Listagem de usuários ou id: ' . $id;
});

$app->get('/postagens[/{ano}[/{mes}]]', function($Request, $Response) {
    $mes = $Request->getAttribute('mes');
    $ano = $Request->getAttribute('ano');

    echo "Listagem de postagens: <br> **/$mes/$ano";
});

$app->get('/lista/{itens:[a-zA-Z/]*}', function($Request, $Response) {
    $itens = $Request->getAttribute('itens');

    var_dump(explode('/', $itens));
});

// Nome de rotas
$app->get('/blog/postagens/{id}', function($Request, $Response) {
    echo 'Listar postagens para um ID';
})->setName('blog');

// Recupera uma rota a partir de seu nome.
$app->get('/meusite', function($Request, $Response) {
    $retorno = $this->get('router')->pathFor('blog', ['id' => "5"]);

    echo $retorno;
});

// Agrupamento de rotas
$app->group('/v1', function() {
    $this->get('/usuarios', function() {
        echo 'Listagem de usuários - Versão 1';
    });

    $this->get('/postagens', function() {
        echo 'Listagem de postagens - Versão 1';
    });
});

$app->run();

?>