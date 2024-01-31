<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrearRutaController extends AbstractController
{
    #[Route('/crear/ruta', name: 'app_crear_ruta')]
    public function index(): Response
    {
        return $this->render('crear_ruta/index.html.twig', [
            'controller_name' => 'CrearRutaController',
        ]);
    }
}
