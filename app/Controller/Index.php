<?php

namespace App\Controller;

use Core\AbstractController;

class Index extends AbstractController
{

    public function actionIndex()
    {
        echo __CLASS__ . ' method: ' . __METHOD__;
    }
}