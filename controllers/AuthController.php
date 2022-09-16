<?php

namespace app\controllers;


use app\controllers\base\BaseController;
use app\services\AuthService;

class AuthController extends BaseController
{
    private $service;

    /**
     * set default service by auth
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->service = new AuthService();
    }

    /**
     * login user
     */
    public function login() {
        if ($this->isPost()) {
            if ($this->service->login($_POST)) {
                $this->setFlash('Hello', true);
                $this->redirect('/task/index');
                return;
            }
            $this->setFlash('Username or password is incorrect', false);
        }
        $this->render('auth/login.php', [], 'Login');
    }

    /**
     * logout user
     */
    public function logout() {
        $_SESSION['authorized'] = false;
        $_SESSION['user_id'] = null;
        $this->redirect('/task/index');
    }
}