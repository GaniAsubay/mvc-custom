<?php

namespace app;


use app\routes\RouteController;

class Application
{
    public function run(array $config = [])
    {
        RouteController::run();
    }

    public static function isGuest() : bool
    {
        if (!empty($_SESSION['authorized']) && $_SESSION['authorized'] == true) {
            return false;
        }
        return true;
    }
}