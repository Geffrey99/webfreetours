<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;  // Asegúrate de importar la clase necesaria
use App\Repository\VisitaRepository;  // Asegúrate de importar la clase necesaria

class CrearRutaController extends AbstractController
{
    private $entityManager;

    // Inyecta el EntityManager en el constructor
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/crear/ruta', name: 'app_crear_ruta')]
    public function index(VisitaRepository $visitaRepository): Response
    {
        // Llama a la función seleccionarGuias para obtener la lista de guías
        $guias = $this->seleccionarGuias();
       
        $visitas = $visitaRepository->findAllVisitas();

        return $this->render('crear_ruta/index.html.twig', [
            'controller_name' => 'CrearRutaController',
            'guias' => $guias, // Pasa la lista de guías a la plantilla
        'visitas' => $visitas,
        ]);
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
