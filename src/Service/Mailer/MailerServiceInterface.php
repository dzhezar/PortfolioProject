<?php


namespace App\Service\Mailer;


interface MailerServiceInterface
{
    public function mail(string $name, string $email, string $text);
}