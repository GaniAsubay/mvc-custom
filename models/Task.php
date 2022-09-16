<?php

namespace app\models;


use app\components\QueryBuilder;

class Task extends QueryBuilder
{
    public $id;
    public $name;
    public $email;
    public $description;
    public $status;

    const STATUS_NOT_FULFILLED = 0;
    const STATUS_PERFORMED = 1;
    const STATUS_EDITED_ADMIN = 2;

    public function tableName(): string
    {
        return 'tasks';
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusText()
    {
        return self::getStatusList()[$this->status];
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_NOT_FULFILLED => 'Not fulfilled',
            self::STATUS_PERFORMED => 'Performed',
            self::STATUS_EDITED_ADMIN => 'Performed <br> Edited by admin'
        ];
    }
}