<?php

namespace Core;


abstract class AbstractController
{
    /** @var View */
    protected View $view;

    /**
     * @param View $view
     */
    public function setView(View $view): void
    {
        $this->view = $view;
    }

    abstract function actionIndex();

    /**
     * @param string $url
     * @return mixed
     * @throws RedirectException
     */
    protected function redirect(string $url)
    {
        throw new RedirectException($url);
    }
}