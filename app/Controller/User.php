<?php

namespace App\Controller;

use Core\AbstractController;

class User extends AbstractController
{
    public function actionIndex()
    {
        echo __CLASS__ . ' method: ' . __METHOD__;
    }

    public function actionLogin()
    {
        echo __CLASS__ . ' method: ' . __METHOD__;
    }

    public function actionRegister()
    {
        echo __CLASS__ . ' method: ' . __METHOD__;
    }
}