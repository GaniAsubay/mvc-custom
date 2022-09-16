<?php
/**
 * Created by PhpStorm.
 * User: gani
 * Date: 9/17/22
 * Time: 12:18 AM
 */

namespace app\components\helpers;


use app\models\Task;

class TaskHelper
{
    public static function checkChangedDescription($newDescription, $oldDescription, &$data) : void
    {
        similar_text($newDescription, $oldDescription, $percent);
        if ($percent != 100) {
            $data['status'] = Task::STATUS_EDITED_ADMIN;
        }
    }
}