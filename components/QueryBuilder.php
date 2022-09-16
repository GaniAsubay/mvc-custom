<?php

namespace app\components;


abstract class QueryBuilder extends DB
{
    private $condition;
    private $limit;
    private $orderBy;
    private $join;
    private $paginationPage = 1;
    private $select = '*';

    /**
     * table name
     * @return string
     */
    abstract public function tableName(): string;


    /**
     * reset properties after execute
     */
    public function resetProperties() {
        $this->condition = null;
        $this->limit = null;
        $this->orderBy = null;
        $this->join = null;
    }

    /**
     * Select query begin
     * @return array
     */
    public function get()
    {
        $this->build();
        $result = $this->result();
        $this->resetProperties();
        return $result;

    }

    /**
     * condition
     * @param $condition
     * @return $this
     */
    public function where($condition)
    {
        $this->condition = $condition;
        return $this;
    }

    /**
     * order
     * @param string $orderBy
     * @return $this
     */
    public function orderBy(string $orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * set limit
     * @param int $limit
     * @return $this
     */
    public function limit(int $limit)
    {
        $this->limit = $limit;
        return $this;
    }

    /**
     * join
     * @param $join
     * @return $this
     */
    public function join($join)
    {
        $this->join = $join;
        return $this;
    }

    /**
     * get actual page
     * @param $page
     * @return $this
     */
    public function pagination($page)
    {
        $this->paginationPage = $page;
        return $this;
    }

    /**
     * set select
     * @param $select
     * @return $this
     */
    public function select($select)
    {
        $this->select = $select;
        return $this;
    }

    /**
     * set other sql
     * @param $sql
     * @return $this
     */
    public function setSql($sql)
    {
        $this->sql = $sql;
        return $this;
    }

    /**
     * build sql code
     */
    private function build()
    {
        $this->sql = "SELECT ";

        if ($this->select) {
            $this->sql .= $this->select;
        }
        $this->sql .= " from {$this->tableName()} ";
        if ($this->join) {
            $this->sql .= $this->join;
        }
        if ($this->condition) {
            $this->sql .= " WHERE {$this->condition}";
        }

        if ($this->orderBy) {
            $this->sql .= " ORDER BY {$this->orderBy}";
        }

        if ($this->limit) {
            $startLimit = ($this->paginationPage - 1) * $this->limit;
            $this->sql .= " LIMIT {$startLimit}, {$this->limit}";
        }
    }
    /**
     * Select query end
     */

    /**
     * @param array $params
     * @return QueryBuilder
     */

    public function setParams($params = [])
    {
        foreach ($params as $key => $param) {
            $params[$key] = strip_tags($param);
        }
        $this->params = $params;
        return $this;
    }
}