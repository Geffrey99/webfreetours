<?php
namespace App\Controller;

use App\Service\MessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class enviaCorreoController extends AbstractController
{
    #[Route('/enviar-correo', name: 'enviar_correo')]
    public function enviarCorreo(MessageGenerator $messageGenerator)
    {
        
        $correo = 'destinatario@example.com';
        $body = 'Este es el cuerpo del correo probaaandoooo';

        
        $enviado = $messageGenerator->sendMail($correo, $body);

        if ($enviado) {
            // Realizaaaa acciones adicionaleees si el correo se envió con éxito
            return new Response('¡Correoooo enviado con éxito!');
        } else {
            // Manejaaaa el caso en el que el correeo no se pudo enviarr
            return new Response('Errooooor al enviar el correo.', 500);
        }
    }
}