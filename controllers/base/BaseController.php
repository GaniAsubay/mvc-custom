<?php

namespace app\controllers\base;

class BaseController
{
    /**
     * render page
     * @param string $view
     * @param array $vars
     * @param string $title
     */
    protected function render(string $view, $vars = [], $title = 'TITLE')
    {
        extract($vars);
        ob_start();
        require(__DIR__ . "/../../views/{$view}");
        $content = ob_get_clean();
        require(__DIR__ . "/../../views/layouts/main.php");
    }

    /**
     * @param $header
     */
    protected function redirect($header)
    {
        header("Location: {$header}");
    }

    /**
     * checking request is post
     * @return bool
     */
    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function setFlash(string $message, bool $code)
    {
        $_SESSION['_flash']['init'] = true;
        $_SESSION['_flash']['flashCode'] = ($code == 0) ? 'danger' : 'success';
        $_SESSION['_flash']['flashMessage'] = $message;
    }
}