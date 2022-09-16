<?php
/**
 * Created by PhpStorm.
 * User: gani
 * Date: 9/16/22
 * Time: 11:26 PM
 */

function dd($arg)
{
    echo '<pre>';
    var_dump($arg);
    die;
}


function updateQueryBySorting(array $newQueryAttributes): string
{
    $query = $_GET;
    foreach ($newQueryAttributes as $key => $attribute) {
        $query[$key] = $attribute;
    }
    return $_SERVER['PHP_SELF'] . '?' . http_build_query($query);
}

function my_session_flash_get(string $key)
{
    if (isset($_SESSION['_flash'][$key])) {
        $data = $_SESSION['_flash'][$key];
        unset($_SESSION['_flash'][$key]);

        return $data;
    } else
        return '';
}