<?php

namespace App\Controller;

use Core\AbstractController;

class Blog extends AbstractController
{
    /**
     * @throws \Core\RedirectException
     */
    public function actionIndex()
    {
        if (!$this->user) {
            $this->redirect('user/register');
        }
        echo __CLASS__ . ' method: ' . __METHOD__;;
    }
}