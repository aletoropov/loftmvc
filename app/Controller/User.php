<?php

namespace App\Controller;

use Core\AbstractController;
use App\Model\User as UserModel;

class User extends AbstractController
{
    public function actionIndex()
    {
        echo __CLASS__ . ' method: ' . __METHOD__;
    }

    public function actionLogin()
    {
        $name = trim((string) filter_input(INPUT_POST, 'name'));
        $password = trim((string) filter_input(INPUT_POST, 'password'));

        $user = UserModel::getByName($name);
        if (!$user) {
            $this->view->assign('error', 'Пользователь не найден');
            exit('Пользователь не найден!'); // TODO: сделать шаблон
        }

        if (!password_verify($password, $user->getPassword())) {
            $this->view->assign('error', 'Пароли не совпадают');
            exit('Пароль не верный!'); // TODO: сделать шаблон
        }

        $_SESSION['id'] = $user->getId();
    }

    /**
     * @throws \Core\RedirectException
     */
    public function actionRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = filter_input(INPUT_POST, 'name');
            $gender = UserModel::GENDER_MALE;

            if (strlen(filter_input(INPUT_POST, 'password')) < 4) {
                $this->view->assign('error', 'Длина пароля не может быть меньше 4-х символов');
                exit('Длина пароля не может быть меньше 4-х символов');
            }

            $password = password_hash(filter_input(INPUT_POST, 'password'), PASSWORD_BCRYPT);

            $user = (new \App\Model\User())
                ->setName($name)
                ->setGender($gender)
                ->setPassword($password);

            $userId = $user->save();

            $this->redirect('/blog/index');
        }

        echo $this->view->render('User/register');
    }

    public function actionProfile()
    {
        echo  $this->view->render('User/profile', ['user' => UserModel::getById((int) $_GET['id'])]);
    }
}