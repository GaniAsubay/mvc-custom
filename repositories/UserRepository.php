<?php

namespace app\repositories;


use app\models\User;

class UserRepository
{
    private $model;

    /**
     * set default model
     * UserRepository constructor.
     */
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * get all users
     * @return array
     */
    public function getAll(): array
    {
        return $this->model->orderBy("id DESC")->get();
    }

    /**
     * get users by select
     * @return array
     */
    public static function getAllBySelect(): array
    {
        return (new User())->select('id, name')->get();
    }
}