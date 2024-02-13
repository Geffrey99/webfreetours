<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuideController extends AbstractController
{
    #[Route('/guide', name: 'app_guide')]
    public function index(): Response
    {
        return $this->render('guide/index.html.twig', [
            'controller_name' => 'GuideController',
        ]);
    }

 /**
     * @Route("/seleccionar-guias", name="seleccionar_guias")
     */
    // public function seleccionarGuias()
    // {
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $userRepository = $entityManager->getRepository('App\Entity\User');

    //     // Seleccionar usuarios con el rol 'ROLE_GUIDE'
    //     $guias = $userRepository->findBy(['roles' => ['ROLE_GUIDE']]);

    //     return $this->render('crear_ruta/index.html.twig', ['guias' => $guias]);
    // }
}