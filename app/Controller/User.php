<?php
namespace App\Controller;

use Core\AbstractController;

class User extends AbstractController
{
    public function actionLogin()
    {
        echo __CLASS__ . ' method: ' . __METHOD__;
    }
}