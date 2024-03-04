<?php
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

    public function notifyOfSiteUpdate(string $correo = "@null.es", string $body = "cuerpo por defecto"): bool
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
            ->to($correo)
            ->subject('este es el correo de prueba')
            ->text($body)
            ->html("<p>$body</p>");
    
        return $this->mailer->send($email) !== null;
    }
}