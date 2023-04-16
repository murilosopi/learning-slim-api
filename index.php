<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Capsule\Manager as Capsule;

require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

// Database
$container = $app->getContainer();

// Illuminate -> query builder
$container['db'] = function() {
    $capsule = new Capsule;

    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'slim',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

$app->get('/usuarios', function(Request $request, Response $response) {
    # CREATE - Criação da tabela 'usuarios':
    $db = $this->db->schema();
    $db->dropIfExists('usuarios');
    $db->create('usuarios', function($table) {
        $table->increments('id');
        $table->string('nome');
        $table->string('email');
        $table->timestamps();
    });

    # INSERT INTO - Inserção de usuários
    $db = $this->db;
    $db->table('usuarios')->insert([
        'nome' => 'Murilo Sousa Pinheiro',
        'email' => 'murilo@gmail.com',
    ]);

    # UPDATE - Atualização de registros da tabela 'usuarios'    
    $db = $this->db;
    $db->table('usuarios')->where('id', 1)
                          ->update(['nome' => 'Murilo Sopi']);

    # DELETE FROM - Deletar usuarios
    $db = $this->db;
    $db->table('usuarios')
            ->where('id', 1)
            ->delete();
    
    # SELECT * FROM - Listar usuarios
    $tUsuarios = $this->db->table('usuarios');
    foreach($tUsuarios->get() as $u) {
        echo "$u->id - $u->nome - $u->email <br>";
    };


});

$app->run();


?>