<?php
// src/Controller/Api/RutaApi.php

namespace App\Controller\Api;

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
class RutaApi extends AbstractController
{
    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
    }



    #[Route("/findAll", name: "findAll", methods: ["GET"])]
    public function findAll(RutaRepository $rutaRepository): Response
    {
        $rutas = $rutaRepository->findAll();
        $data = $this->serializer->serialize($rutas, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route("/findById/{id}", name: "findById", methods: ["GET"])]
    public function findById($id, RutaRepository $rutaRepository): Response
    {
        $ruta = $rutaRepository->find($id);
        if (!$ruta) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }
        $data = $this->serializer->serialize($ruta, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route("/insert", name: "insert", methods: ["POST"])]
    public function insert(Request $request): JsonResponse
    {
        // Obtener los datos en formato JSON
        $data = $request->request->all();
        // $data = json_decode($request->getContent(), true);
        // $data = json_decode($request->request->get('data'), true);
        $ruta = new Ruta;
        $ruta->setNombre($data['nombre'] ?? null);
        $ruta->setDescripcion($data['descripcion'] ?? null);
        $file = $request->files->get('foto');
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move(
            $this->getParameter('fotos_visitas'),
            $fileName
        );
        $ruta->setFoto($fileName);
        $ruta->setPuntoInicio($data['punto_inicio'] ?? null);
        $ruta->setParticipantes($data['participantes'] ?? null);
        $ruta->setProgramacion($data['programacion'] ?? 'Valor_Predeterminado');
        $fecha_inicio = \DateTime::createFromFormat('d/m/Y H:i:s', $data['fecha_inicio']);
if ($fecha_inicio === false) {
    throw new \Exception('La fecha de inicio no es válida: ' . $data['fecha_inicio']);
}
$ruta->setFechaInicio($fecha_inicio);

        $ruta->setFechaInicio($fecha_inicio);
        
        $fecha_fin = \DateTime::createFromFormat('d/m/Y H:i:s', $data['fecha_fin']);
        if ($fecha_fin === false) {
            // La fecha no pudo ser parseada, maneja el error aquí
            throw new \Exception('La fecha de fin no es válida.');
        }
        $ruta->setFechaFin($fecha_fin);
        
        
        
        // $ruta->setFechaFin($data['fecha_fin'] ?? null);
        // $ruta->setPuntoInicio($data['punto_inicio'] ?? null);

        $this->entityManager->persist($ruta);
        $this->entityManager->flush();


        // Devuelve una respuesta JSON con el ID de la nueva entidad creada y el código de estado HTTP 201 (Created)
        return new JsonResponse(['id' => $ruta->getId()], JsonResponse::HTTP_CREATED);
    }

    #[Route("/update/{id}", name: "update", methods: ["PUT"])]
    public function update(Request $request, $id, RutaRepository $rutaRepository): Response
    {
        $ruta = $rutaRepository->find($id);
        if (!$ruta) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }
        $data = json_decode($request->getContent(), true);
        // Aquí puedes actualizar la entidad Ruta con los datos recibidos en $data
    }

    #[Route("/delete/{id}", name: "delete", methods: ["DELETE"])]
    public function delete($id, RutaRepository $rutaRepository): Response
    {
        $entityManager = $rutaRepository->getManager();
        $ruta = $entityManager->getRepository(Ruta::class)->find($id);
        if (!$ruta) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }
        $entityManager->remove($ruta);
        $entityManager->flush();
        return new Response(null, Response::HTTP_OK);
    }
}
