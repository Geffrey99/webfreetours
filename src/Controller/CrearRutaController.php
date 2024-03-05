<?php

namespace App\Controller;

use App\Entity\Visita;
use App\Entity\localidad;
use App\Entity\User;
use app\Entity\Ruta;
use App\Repository\UserRepository;
use App\Repository\RutaRepository;
USE App\Repository\VisitaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;  
USE Symfony\Component\HttpFoundation\Request;
use App\Repository\LocalidadRepository;
USE Symfony\Component\Serializer\SerializerInterface;
use App\Controller\Api\DevueltaRoute;
use EasyCorp\Bundle\EasyAdminBundle\Controller\DashboardControllerInterface;

class CrearRutaController extends AbstractController
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

    
    #[Route('/crear/ruta', name: 'app_crear_ruta')]
    public function index(VisitaRepository $visitaRepository, LocalidadRepository $localidadesRepository, UserRepository $userRepository ): Response
    {
        $localidades = $localidadesRepository->findAllLocalidades();
        $visitas = $visitaRepository->findAllVisitas();
        $guias = $userRepository->findUsersByRole('ROLE_GUIDE');
    
        return $this->render('crear_ruta/index.html.twig', [
            'controller_name' => 'CrearRutaController',
            'localidades' => $localidades,
            'visitas' => $visitas,
            'guias' => $guias
        ]);
    }
    
    



    #[Route('/filtrar-visitas/{localidadId}', name: 'filtrar_visitas')]
    public function filtrarVisitas($localidadId, VisitaRepository $visitaRepository): Response
    {
        $visitas = $visitaRepository->findVisitasByLocalidad($localidadId);
    
        return $this->json(['visitas' => $visitas]);
    }
    
    

    public function seleccionarGuias()
    {
        
        $userRepository = $this->entityManager->getRepository('App\Entity\User');

        
        $guias = $userRepository->findBy(['roles' => ['ROLE_GUIDE']]);

        return $guias;
    }

    #[Route('/editar/ruta', name: 'app_editar_ruta')]
    public function editarRuta(): Response
    {
        // $response = $this->devueltaRoute->uploadCreateRoute(new Request(), $this->entityManager);
        // $rutas = json_decode($response->getContent(), true);
    
        return $this->render('crear_ruta/editar_ruta.html.twig', [
            // 'rutas' => $rutas
        ]);
    }



}
