<?php


namespace App\Service\Mailer;


use Swift_Mailer;
use Swift_Message;
use Twig\Environment;

class MailerService implements MailerServiceInterface
{
    private $environment;
    private $mailer;

    /**
     * MailerService constructor.
     * @param $environment
     * @param $mailer
     */
    public function __construct(Environment $environment, Swift_Mailer $mailer)
    {
        $this->environment = $environment;
        $this->mailer = $mailer;
    }


    public function mail(string $name, string $email, string $text)
    {
        $mail = new Swift_Message('You have a new message!');
        $mail->setFrom($email)
            ->setTo('dzhezik@gmail.com')
            ->setBody(
                $this->environment->render(
                    'mail/mail.html.twig',
                    [
                        'name' => $name,
                        'email' =>$email,
                        'text' =>$text
                    ]
                ),
                'text/html'
            );
        return $this->mailer->send($mail);

    }
}