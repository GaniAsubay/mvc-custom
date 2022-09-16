<?php

namespace app\services;


use app\models\User;

class AuthService
{
    private $model;

    /**
     * set default model
     * AuthService constructor.
     */
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * checking the user for existence and writing to the session
     * @param $data
     * @return bool
     */
    public function login($data) : bool
    {
        $user = $this->model->where('name = :name')->setParams(['name' => $data['login']])->limit(1)->get();
        if (!empty($user)) {
            if (password_verify($data['password'], $user[0]->password)) {
                $_SESSION['authorized'] = true;
                $_SESSION['user_id'] = $user[0]->id;
                return true;
            }
        }
        return false;
    }
}