<?php

namespace app\models;


use app\components\QueryBuilder;

class User extends QueryBuilder
{
    public $id;
    public $name;
    public $role;
    public $password;

    /**
     * @return string
     */
    public function tableName(): string
    {
        return 'users';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getRole()
    {
        return $this->role;
    }
}