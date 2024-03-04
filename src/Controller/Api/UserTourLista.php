<?php
namespace App\Controller\Api;

use App\Entity\UserTour;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class UserTourLista extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/user-tour/{id}/update-num-gente-reserva', name: 'update_user_tour_num_gente_reserva', methods: ['POST'])]
    public function updateNumGenteReserva(Request $request, UserTour $userTour): JsonResponse
    {
        $numGenteReserva = $request->request->get('num_gente_reserva');

        if (!is_numeric($numGenteReserva)) {
            return new JsonResponse(['error' => 'RESPUESTA INVALIDA'], 400);
        }

        $userTour->setNumGenteReserva($numGenteReserva);

        $this->entityManager->persist($userTour);
        $this->entityManager->flush();

       // return $this->redirectToRoute('app_pasar_lista'); 
    //    return new JsonResponse($jsonContent, 303, [], true);
    var_dump('PERFECTO, SE ACTUALIZO EL NUMERO DE GENTE RESERVA');
         return new JsonResponse(['success' => true, 'message' => 'Num Gente Reserva updated successfully']);
    }
}
