<?php

namespace App\Controller;

class Twig extends \Core\AbstractController
{

    public function actionIndex()
    {
        $loader = new \Twig\Loader\ArrayLoader([
            'index' => 'Hello {{ name }}!',
        ]);
        $twig = new \Twig\Environment($loader);
    }
}