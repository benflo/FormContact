<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 06/05/2019
 * Time: 11:27
 */

namespace App\Service;


class MailGenerator
{
    public function getHappyMessage()
    {
        $messages = [
            'youpi!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}