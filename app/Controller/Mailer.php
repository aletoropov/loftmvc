<?php

namespace App\Controller;

use Core\AbstractController;
use Swift_Message;
use Swift_SmtpTransport;

class Mailer extends AbstractController
{
    public function actionIndex()
    {
        // Создаем подключение
        $transport = (new Swift_SmtpTransport('smtp.yandex.ru', 25))
            ->setUsername('loftmvcte12')
            ->setPassword('mazquvelqnvucazh')
        ;

        $mailer = new \Swift_Mailer($transport);

        // Создаем сообщение
        $message = (new Swift_Message('Тема'))
            ->setFrom(['loftmvcte12h@yandex.ru' => 'Alexandr Toropov'])
            ->setTo(['toropovsite@yandex.ru' => 'Alexandr'])
            ->setBody('Это текст сообщения')
        ;

        // Отправляем сообщений
        $result = $mailer->send($message);

        var_dump($result);
    }

}