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
        if ($_SESSION['authorized']) {
            return false;
        }
        return true;
    }
}