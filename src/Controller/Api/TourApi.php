<?php


namespace App\Controller\Api;

use App\Entity\Tour;
use App\Entity\Ruta;
use App\Repository\RutaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;




#[Route("/api/ruta", name: "ruta-")]
class TourApi extends AbstractController
{
    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    #[Route('/gettours', name: 'api_tours')]
    public function getTours(): Response
    {
        // Obtén los tours desde tu repositorio
        $tours = $this->entityManager->getRepository(Tour::class)->findAll();
    
        // Convierte los tours a un formato que FullCalendar pueda entender
        $toursArray = [];
        foreach ($tours as $tour) {
            $toursArray[] = [
                // 'id' => $tour->getId(),
                'title' => $tour->getCodRuta()->getNombre() . ' - ' . $tour->getFechaHora()->format('H:i'),
               // 'hora' => $tour->getFechaHora()->format('H:i'),  // Formato de hora
               'start' => $tour->getFechaHora()->format(\DateTimeInterface::ATOM),  // FullCalendar necesita el formato ISO8601
                // Agrega aquí otros campos según sea necesario
            ];
        }
    
        // Devuelve los datos en formato JSON
        return new JsonResponse($toursArray);
    }

    #[Route('/gettour/{id}', name: 'api_tour')]
    public function getToursByRuta($id): Response
    {
        // Obtén la ruta desde tu repositorio
        $ruta = $this->entityManager->getRepository(Ruta::class)->find($id);
    
        if (!$ruta) {
            throw $this->createNotFoundException('No se encontró la ruta con id '.$id);
        }
    
        // Obtén los tours relacionados con la ruta
        $tours = $ruta->getTours(); // Asume que tienes un método getTours en tu entidad Ruta
    
        // Convierte los tours a un formato que puedas utilizar
        $toursArray = [];
        foreach ($tours as $tour) {
            $toursArray[] = [
                 'id' => $tour->getId(),
                'title' => $tour->getFechaHora()->format('H:i'),  // Formato de hora
                'start' => $tour->getFechaHora()->format(\DateTimeInterface::ATOM),  // FullCalendar necesita el formato ISO8601
                // Agrega aquí otros campos según sea necesario
            ];
        }
    
        // Devuelve los datos en formato JSON
        return new JsonResponse($toursArray);
    }
    

    // Devuelve los datos en formato JSON

}    