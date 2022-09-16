<?php

namespace app\services;


use app\models\Task;

class TaskService
{
    /**
     * create task
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $model = new Task();
        $model->setSql('INSERT INTO tasks (email, description, name) VALUES (:email,:description,:name)')->setParams($data);
        return $model->insert();
    }

    /**
     * update task
     * @param array $data
     * @return bool
     */
    public function update(array $data): bool
    {
        $model = new Task();
        $model->setSql('UPDATE tasks SET email=:email, description=:description, name=:name, status=:status WHERE id=:id')->setParams($data);
        return $model->insert();
    }

    /**
     * update tasl status
     * @param int $status
     * @param int $id
     * @return bool
     */
    public function updateStatus(int $status, int $id): bool
    {
        $model = new Task();
        $model->setSql('UPDATE tasks SET status =:status WHERE id=:id')->setParams(['status' => $status, 'id' => $id]);
        return $model->insert();
    }


}