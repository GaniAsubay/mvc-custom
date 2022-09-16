<?php

namespace app\routes;

use app\controllers\TaskController;
use Exception;


class RouteController
{
    /**
     * mini router )
     * @throws Exception
     */
    public static function run()
    {
        $uri = explode('/', explode('?', $_SERVER['REQUEST_URI'])[0]);
        $controller = 'app\controllers\\' . ucfirst($uri[1]) . "Controller";
        if (!empty($uri[1]) && class_exists($controller)) {
            $function = $uri[2];
            $controller = new $controller();
            $controller->$function();
            return;
        }
        (new TaskController)->index();
    }
}