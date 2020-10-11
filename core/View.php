<?php

namespace core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View {

    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route) {
        $this->route = $route;
        $this->path = $route['controller'].'/'.$route['action'];
    }

    public function render($title, $actions ,$vars = []) {
        require_once 'vendor/autoload.php';
        $loader = new FilesystemLoader('views/template/');
        $twig = new Environment($loader);
        if ($actions === '') {
            echo $twig->render('index.html.twig', ['title' => $title, 'users' => $vars]);
        }
        if ($actions === 'add'){
            echo $twig->render('add.html.twig', ['title' => $title]);
        }
        if ($actions === 'edit'){
            echo $twig->render('edit.html.twig', ['title' => $title, 'user'=>$vars]);
        }

    }

    public function redirect($url) {
        header('location: '.$url);
        exit;
    }

    public static function errorCode($code) {
        http_response_code($code);
        require_once 'vendor/autoload.php';
        $loader = new FilesystemLoader('views/template/');
        $twig = new Environment($loader);
        echo $twig->render($code.'.html.twig',['title'=> 'Error']);
    }

    public function message($status, $message) {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url) {
        exit(json_encode(['url' => $url]));
    }

}