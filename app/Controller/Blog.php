<?php

namespace App\Controller;

use Core\AbstractController;

class Blog extends AbstractController
{
    public function indexAction()
    {
        echo 'this is blog controller';
    }
}