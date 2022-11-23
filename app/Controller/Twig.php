<?php

namespace App\Controller;

class Twig extends \Core\AbstractController
{

    public function actionIndex()
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $twig = new \Twig\Environment($loader);

        $template = $twig->load('index.html');
        echo $template->render(['name' => 'Alexandr']);
    }
}