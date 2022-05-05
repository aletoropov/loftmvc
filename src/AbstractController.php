<?php

namespace Core;


abstract class AbstractController
{
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