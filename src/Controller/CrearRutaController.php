<?php

namespace App\Controller;

use App\Entity\Visita;
use App\Entity\localidad;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;  // Asegúrate de importar la clase necesaria
use App\Repository\VisitaRepository;  // Asegúrate de importar la clase necesaria
use App\Repository\LocalidadRepository;
class CrearRutaController extends AbstractController
{
    private $entityManager;

    // Inyecta el EntityManager en el constructor
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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
        // Utiliza el EntityManager para acceder a la base de datos
        $userRepository = $this->entityManager->getRepository('App\Entity\User');

        // Seleccionar usuarios con el rol 'ROLE_GUIDE'
        $guias = $userRepository->findBy(['roles' => ['ROLE_GUIDE']]);

        return $guias;
    }
}
