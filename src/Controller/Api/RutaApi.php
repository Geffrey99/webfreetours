<?php


namespace App\Controller\Api;

use App\Entity\Ruta;
use App\Entity\Tour;
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
        $ruta->setProgramacion($data['programacion'] ?? []);
        $fecha_inicio = \DateTime::createFromFormat('Y-m-d', $data['fecha_inicio']);
        if ($fecha_inicio === false) {
              throw new \Exception('La fecha de inicio no es válida: ' . $data['fecha_inicio']);
            }
            $ruta->setFechaInicio($fecha_inicio);

        $ruta->setFechaInicio($fecha_inicio);
        
        $fecha_fin = \DateTime::createFromFormat('Y-m-d', $data['fecha_fin']);
        if ($fecha_fin === false) {
           
            throw new \Exception('La fecha de fin no es válida.');
        }
        $ruta->setFechaFin($fecha_fin);
        
        $this->entityManager->persist($ruta);
        $this->entityManager->flush();

        // Devuelve una respuesta JSON con el ID de la nueva entidad creada y el código de estado HTTP 201 (Created)
        return new JsonResponse(['id' => $ruta->getId()], JsonResponse::HTTP_CREATED);
    }


    #[Route("/assign_programacion", name: "assign_programacion", methods: ["POST"])]
    public function assignProgramacion(Request $request): JsonResponse
    {
       
        $data = json_decode($request->getContent(), true);
    
       
        $rutaId = $data['rutaId'] ?? null;
    
        // Verifica si se proporcionó el ID de la ruta
        if ($rutaId === null) {
            return new JsonResponse(['error' => 'ID de ruta no proporcionado'], JsonResponse::HTTP_BAD_REQUEST);
        }
    
        // Obtiene la ruta existente por su ID
        $ruta = $this->entityManager->getRepository(Ruta::class)->find($rutaId);
    
        if (!$ruta) {
            return new JsonResponse(['error' => 'Ruta no encontrada'], JsonResponse::HTTP_NOT_FOUND);
        }
    
        // Obtiene los datos de programación
        $programacionData = $data['programacion'] ?? [];
    
        
        $ruta->setProgramacion($programacionData);
    
        foreach ($data['programacion'] as $programacion) {
            // Convertir las fechas al formato 'Y-m-d'
            echo date_default_timezone_get(); 
            list($fechaInicio, $fechaFin) = explode(' - ', $programacion['rangoFecha']);
            $fechaInicio = \DateTime::createFromFormat('d/m/Y', $fechaInicio);
            $fechaFin = \DateTime::createFromFormat('d/m/Y', $fechaFin);
    
           
            $unDia = new \DateInterval('P1D');
    
           
            $rangoFechas = new \DatePeriod($fechaInicio, $unDia, $fechaFin->add($unDia));
    
            foreach ($rangoFechas as $fecha) {
               
                $tour = new Tour();
    
                
                $tour->setCodRuta($ruta);
                $fecha_hora = \DateTime::createFromFormat('Y-m-d H:i', $fecha->format('Y-m-d') . ' ' . $programacion['hora'], new \DateTimeZone('Europe/Berlin'));
                // var_dump($fecha_hora);
                var_dump($fecha_hora->format('Y-m-d H:i:s'));
                $tour->setFechaHora($fecha_hora);
                $tour->setIdGuide($programacion['guia']);
    
               
                $this->entityManager->persist($tour);
            }
        }
    
        
        $this->entityManager->flush();
    
       
        return new JsonResponse(['message' => 'Programación asignada Y TOUR CREADOS CON EXITO'], JsonResponse::HTTP_OK);
    }
    
    
    #[Route("/update/{id}", name: "update", methods: ["PUT"])]
    public function update(Request $request, $id, RutaRepository $rutaRepository): Response
    {
        $ruta = $rutaRepository->find($id);
        if (!$ruta) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }
        $data = json_decode($request->getContent(), true);
       
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
