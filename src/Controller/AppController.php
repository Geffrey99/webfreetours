<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Api\DevueltaRoute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Ruta;
use App\Entity\Tour;
use App\Entity\User;
use App\Entity\UserTour;
Class AppController extends AbstractController
 {

    private DevueltaRoute $devueltaRoute;
    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;
    public function __construct(DevueltaRoute $devueltaRoute, SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->devueltaRoute = $devueltaRoute;
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }

    #[Route('/', name:'app_home')]
    public function homepage() : Response {

        $response = $this->devueltaRoute->uploadCreateRoute(new Request(), $this->entityManager);
        $rutas = json_decode($response->getContent(), true);

        return $this->render('home.html.twig', [
            'titulo' => 'FreeTours',
            'home' => 'Pagina Home',
            'rutas'=> $rutas
        ]);
    }

    

}