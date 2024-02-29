<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
USE App\Entity\Ruta;
use App\Entity\Tour;
use App\Entity\User;
use App\Entity\UserTour;
use App\Form\ReservarFormTour;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
USE App\Controller\Api\DevueltaRoute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;


class ClienteController extends AbstractController
{

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }



    #[Route('/cliente', name: 'app_cliente')]
    public function index(): Response
    {
        return $this->render('cliente/index.html.twig', [
            'controller_name' => 'ClienteController',
        ]);
    }

    #[Route('/verRutas', name: 'verRutas')]
    public function verRutas(): Response
    {
        $response = $this->forward(DevueltaRoute::class.'::uploadCreateRoute');
        $rutas = json_decode($response->getContent(), true);
    // var_dump($rutas);
        return $this->render('cliente/rutas.html.twig', [
            'rutas' => $rutas,
        ]);
    }

    #[Route('/ruta/{id}/tours', name: 'ruta_tours')]
    public function showTours($id): Response
    {
    $ruta = $this->getDoctrine()->getRepository(Ruta::class)->find($id);

    if (!$ruta) {
        throw $this->createNotFoundException('No se encontró la ruta con id '.$id);
    }

    $tours = $ruta->getTours(); // Asume que tienes un método getTours en tu entidad Ruta

    return $this->render('cliente/tours.html.twig', [
        'tours' => $tours,
    ]);
    }

  #[Route('/reservar/{tourId}', name: 'reservar_tour')]
    public function reservar(Request $request, $tourId): Response 
    {
        // Obtener el tour según el ID proporcionado
        $tour = $this->entityManager->getRepository(Tour::class)->find($tourId);

        if (!$tour) {
            throw $this->createNotFoundException('Tour no encontrado');
        }

        // Crear un nuevo objeto UserTour
        $userTour = new UserTour();

        // Crear el formulario utilizando el formulario ReservarFormTour y pasando el objeto UserTour
        $form = $this->createForm(ReservarFormTour::class, $userTour);

        // Manejar la solicitud del formulario
        $form->handleRequest($request);

        // Si el formulario se envía y es válido, persistimos el UserTour en la base de datos
        if ($form->isSubmitted() && $form->isValid()) {
            $userTour->setCodTour($tour);
            $this->entityManager->persist($userTour);
            $this->entityManager->flush();

            return $this->redirectToRoute('tour_reservado');
        }

        // Renderizar la plantilla Twig con el formulario y los datos del tour
        return $this->render('cliente/tours.html.twig', [
            'form' => $form->createView(),
            'tour' => $tour, // Pasar el objeto tour a la plantilla
        ]);
    }





    #[Route('/misReservas', name: 'verReservas')]
    public function verReservas(): Response
    {
        return $this->render('cliente/reservas.html.twig', [
            // 'controller_name' => 'ClienteController',
        ]);
    }
}
