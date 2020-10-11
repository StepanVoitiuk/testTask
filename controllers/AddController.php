<?php

namespace controllers;

use core\Controller;
use models\User;

class AddController extends Controller
{

    /**
     * @var User
     */
    private $user;

    /**
     * @var $url
     */
    private $url;
     public function __construct($route)
     {
         parent::__construct($route);
         $this->user = new User();
         $this->url = trim($_SERVER['REQUEST_URI'], '/');
     }

    public function addAction(){
        if (isset($_POST)){
            $data = $_POST;
             if ($this->user->addUser($data)){
                 $this->view->redirect('/');
             };
        } else {
            $this->view->render('Add', $this->url);
        }
    }

    public function editAction(){
        if (isset($_GET)){
            $data = $_GET;
            if ($_SERVER['QUERY_STRING']){
                $this->url = trim($this->url, '?'.$_SERVER['QUERY_STRING']);
            }
            if ($this->user->getUser($data)){
                $this->view->render('Edit', $this->url, $this->user->getUser($data)->fetch(\PDO::FETCH_ASSOC));
            }
        }
    }

    public function deleteAction(){
        if (isset($_GET)){
            $data = $_GET;
            if ($this->user->deleteUser($data)){
                $this->view->redirect('/');
            }
        } else {
            $this->view->render('Edit', $this->url);
        }
    }

    public function updateAction()
    {
        if (isset($_POST)){
            $data = $_POST;
            if ($this->user->updateUser($data)){
                $this->view->redirect('/');
            }
        }
    }

}