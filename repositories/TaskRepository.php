<?php

namespace app\repositories;


use app\models\Task;

class TaskRepository
{
    private $model;
    private $limit = 3;

    /**
     * set default model
     * TaskRepository constructor.
     */
    public function __construct()
    {
        $this->model = new Task();
    }

    /**
     * get all tasks by params
     * @return array
     */
    public function getAll() : array
    {
        return $this->model
            ->pagination($this->getPage())
            ->orderBy("{$this->getSortField()} {$this->getSortType()}")
            ->limit($this->limit)
            ->get();
    }

    /**
     * get all tasks by params
     * @return array
     */
    public function getPerformedTasks() : array
    {
        return $this->model
            ->where('status in (?,?)')
            ->pagination($this->getPage())
            ->orderBy("{$this->getSortField()} {$this->getSortType()}")
            ->limit($this->limit)
            ->setParams([Task::STATUS_EDITED_ADMIN, Task::STATUS_PERFORMED])
            ->get();
    }

    /**
     * return one record
     * @param $id
     * @return mixed
     */
    public function getOne($id) : Task
    {
        return $this->model->where("id = :id")->limit(1)->setParams([':id' => $id])->get()[0];
    }

    /**
     * all records count
     * @return int
     */
    public function getAllCount() : int
    {
        $result = $this->model->select('Count(*) as count')->get();
        if (!empty($result)) {
            return $result[0]->count;
        }

        return 0;
    }

    /**
     * return pagination page count
     * @return int
     */
    public function getPaginationPageCount() : int
    {
        $recordsCount = $this->getAllCount();
        if ($recordsCount > 3) {
            return (int)($recordsCount / $this->limit + 1);
        }

        return 1;

    }

    /**
     * @return string
     */
    private function getSortField(): string
    {
        return $_GET['sort'] ?? 'id';
    }

    /**
     * @return string
     */
    private function getSortType(): string
    {
        return $_GET['sortType'] ?? 'desc';
    }

    /**
     * @return int
     */
    private function getPage(): int
    {
        return $_GET['page'] ?? 1;
    }
}