<?php
session_start();


ini_set('display_errors', 'On'); // сообщения с ошибками будут показываться
error_reporting(E_ALL); // E_ALL - отображаем ВСЕ ошибки
require_once '../vendor/autoload.php';
require_once '../functions.php';
$config = require '../config/main.php';

(new \app\Application())->run($config);
