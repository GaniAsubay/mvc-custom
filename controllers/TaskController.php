<?php

namespace app\controllers;

use app\Application;
use app\components\helpers\TaskHelper;
use app\controllers\base\BaseController;
use app\models\Task;
use app\repositories\TaskRepository;
use app\repositories\UserRepository;
use app\services\TaskService;


class TaskController extends BaseController
{
    private $repository;
    private $service;

    /**
     * set default service and repository by task controller
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->repository = new TaskRepository();
        $this->service = new TaskService();
    }

    /**
     * index page
     */
    public function index()
    {
        if (Application::isGuest()) {
            $models = $this->repository->getPerformedTasks();
        } else {
            $models = $this->repository->getAll();
        }

        $paginationPageCount = $this->repository->getPaginationPageCount();
        $isGuest = Application::isGuest();
        $this->render('task/index.php', ['models' => $models, 'paginationPageCount' => $paginationPageCount, 'isGuest' => $isGuest], 'Task list');
    }

    /**
     * create page
     */
    public function create()
    {
        $users = UserRepository::getAllBySelect();
        if ($this->isPost() && $this->service->create($_POST)) {
            $this->redirect('index');
        }
        $this->render('task/create.php', ['users' => $users], 'Create Task');
    }

    /**
     * edit page
     * @throws \Exception
     */
    public function edit()
    {
        $task = $this->findModel();
        $users = UserRepository::getAllBySelect();
        if ($this->isPost()) {
            $data = $_POST;
            if (Application::isGuest()) {
                $this->setFlash('Error: Not authorized', false);
                $this->redirect('index');
                return;
            }
            TaskHelper::checkChangedDescription($data['description'], $task->description, $data);
            if ($this->service->update($data)) {
                $this->redirect('index');
            }
        }
        $this->render('task/update.php', ['model' => $task, 'users' => $users], 'Update Task');
    }

    /**
     * approved page
     * @throws \Exception
     */
    public function approved()
    {
        $task = $this->findModel();
        $this->service->updateStatus(true, $task->id);
        $this->redirect('index');
    }

    /**
     * checking on exists task
     * @return mixed
     * @throws \Exception
     */
    public function findModel()
    {
        $id = $_GET['id'];
        $task = $this->repository->getOne($id);
        if (!$id || !$task) {
            throw new \Exception('Task not found', 404);
        }
        return $task;
    }
}