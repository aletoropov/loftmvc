<?php

namespace App\Controller;

use Core\AbstractController;

class Blog extends AbstractController
{
    public function actionIndex()
    {
        echo 'this is blog controller';
        echo __CLASS__ . ' method: ' . __METHOD__;;
    }
}