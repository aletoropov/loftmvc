<?php

namespace Core;


use App\Model\User;

abstract class AbstractController
{
    /** @var View */
    protected View $view;
    /** @var ?User */
    protected ?User $user = null;

    /**
     * @param View $view
     * @return void
     */
    public function setView(View $view): void
    {
        $this->view = $view;
    }

    /**
     * @param User $user
     * @return void
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
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