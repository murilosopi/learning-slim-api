<?php
namespace MyApp\Controllers;

class Home {
    protected $view;
    // protected $container;

    public function __construct($view /*ou $container */) {
        $this->view = $view;
        // $this->container = $container;
    }

    public function index($request, $response) {
        $view = $this->view;
        // $view = $this->container->get('view');

        return $response->write('Index');
    }

}

?>