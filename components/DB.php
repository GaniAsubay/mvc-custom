<?php

namespace app\components;

class DB
{
    private $db;
    protected $sql;
    protected $params;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        $config = require('../config/db.php');
        $this->db = new \PDO($config['dsn'], $config['username'], $config['password']);
    }

    /**
     * @return \PDO
     */
    protected function getDB(): \PDO
    {
        return $this->db;
    }

    /**
     * @return array
     */
    public function result(): array
    {
        $sth = $this->db->prepare($this->sql);
        $sth->execute($this->params);
        return $sth->fetchAll(\PDO::FETCH_CLASS, get_class($this));
    }

    /**
     * @return bool
     */
    public function insert(): bool
    {
        $sth = $this->db->prepare($this->sql);
        return $sth->execute($this->params);
    }
}