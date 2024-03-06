<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Tour;
use App\Entity\User;

class EditaCalendario extends AbstractController
{
    #[Route('/editarguiaCalendario', name: 'app_editar_guia_calendario')]
    public function index(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $idTour = $request->request->get('idTour');
        $idGuide = $request->request->get('idGuide'); // Asegúrate de obtener el idGuide

        $tour = $entityManagerInterface->getRepository(Tour::class)->find($idTour);

        if ($tour) {
            // Actualiza el campo id_guide con el valor seleccionado
            $tour->setIdGuide($idGuide);

            $entityManagerInterface->persist($tour);
            $entityManagerInterface->flush();

            return new Response("ok hasta luegooooo");
        } else {
            return new Response("Erroreeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee");
        }
    }
}





