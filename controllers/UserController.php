<?php

namespace controllers;
use core\Controller;

class UserController extends Controller
{
    public function indexAction() {
        $result = $this->model->getUsers();
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $this->view->render('Main', $url ,$result);
    }

}