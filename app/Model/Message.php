<?php

namespace App\Model;

use Core\AbstractModel;

class Message extends AbstractModel
{
    private string $message;
    private string $date;
    private int $authorId;

}