<?php
namespace App\Controller;


use App\Entity\RutaVisita;

use App\Repository\VisitaRepository;
use App\Repository\RutaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;


class RutaVisitaController extends AbstractController
{
    private $visitaRepository;
    private $rutaRepository;
    private $entityManager;
    private $SerializerInterface;

    public function __construct(VisitaRepository $visitaRepository, RutaRepository $rutaRepository, EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->visitaRepository = $visitaRepository;
        $this->rutaRepository = $rutaRepository;
        $this->entityManager = $entityManager;
    
    
    }

    #[Route("/rutavisita/create", name:"rutaVisita", methods: ["POST"])]
    public function createRutaVisita(Request $request): JsonResponse
    {
        var_dump($request->request->all());
        // var_dump($request->request->get('g'));
        // var_dump($request->request->get('visitasIds'));

        $visitasIds = json_decode($request->request->get('visitasIds'));
        
        $rutaId = $request->request->get('rutaId');
// var_dump($visitasIds);
// var_dump($rutaId);
        // Buscar la Ruta
        $ruta = $this->rutaRepository->find($rutaId);

        foreach ($visitasIds as $visitaId) { 
        $visita = $this->visitaRepository->find($visitaId);

        // Crear una nueva RutaVisita
        $rutaVisita = new RutaVisita();
        $rutaVisita->setCodVisita($visita);
        $rutaVisita->setCodRuta($ruta);

       
        $this->entityManager->persist($rutaVisita);
        }
        $this->entityManager->flush();

     
        return new JsonResponse(['id' => $rutaVisita->getId()], JsonResponse::HTTP_CREATED);
    }
}
