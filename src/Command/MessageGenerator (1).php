<?php
// src/Service/MessageGenerator.php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mime\Email;

class MessageGenerator
{
    public function __construct(
        private LoggerInterface $logger,
        private string $adminEmail,
        private MailerInterface $mailer,
    ) {}

    // public function getHappyMessage(): string
    // {
    //     $this->logger->info('About to find a happy message!');
    //     $messages = [
    //         'You did it! You updated the system! Amazing!',
    //         'That was one of the coolest updates I\'ve seen all day!',
    //         'Great work! Keep going!',
    //     ];

    //     $index = array_rand($messages);

    //     return $messages[$index];
    // }

    public function notifyOfSiteUpdate(string $correo = "@null.es"): bool
    {
        $email = (new Email())
            ->from('geffrey@freetour.es')
            // ->to($this->adminEmail)
            ->to($correo)
            ->subject('SERVICIO subject')
            ->text('SERVICIO text')
            ->html('<p>SERVICIO html</p>')
        ;

        return $this->mailer->send($email) != null ? true : false;
    }
    

    public function sendMail(string $correo = "@null.es", string $body = "cuerpo por defecto"): bool
    {
        $email = (new Email())
            ->from('geffrey@freetour.es')
            // ->to($this->adminEmail)
            ->to($correo)
            ->subject('Asunto por defecto')
            ->text('{$body}')
            ->html('<p>{$body}</p>')
        ;

        return $this->mailer->send($email) != null ? true : false;
    }
}