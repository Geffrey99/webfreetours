<?php

namespace App\Controller\Api;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Ruta;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\RutaRepository;

#[Route('/ruta', name: 'ruta')]
class DevueltaRoute extends AbstractController
{
    #[Route('/uploadCreateRoute', name: 'upload_create_route', methods: ['GET', 'POST'])]
    public function uploadCreateRoute(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $rutas = $entityManager->getRepository(Ruta::class)->findAll();

        $serializedRutas = $this->serializeRutas($rutas);

        $data = [
            'rutas' => $serializedRutas,
        ];

        return $this->json($data, Response::HTTP_OK);
    }

    private function serializeRutas(array $rutas): array {
        $serializedRutas = [];
        foreach ($rutas as $ruta) {
            // Convertir la colección de tours en un array
            $tours = $ruta->getTours()->toArray();
            $rutaVisitas = $ruta->getRutaVisitas()->toArray();
         

            $serializedRutas[] = [
                'id' => $ruta->getId(),
                'nombre' => $ruta->getNombre(),
                'descripcion' => $ruta->getDescripcion(),
                'foto' => $ruta->getFoto(),
                'punto_inicio' => $ruta->getPuntoInicio(),
                'participantes' => $ruta->getParticipantes(),
                'programacion' => $ruta->getProgramacion(),
                'fecha_inicio' => $ruta->getFechaInicio()->format('Y-m-d H:i:s'),
                'fecha_fin' => $ruta->getFechaFin()->format('Y-m-d H:i:s'),
                
                'tours' => $this->serializeTours($tours), // Pasar el array de tours
                'rutaVisitas' => $this->serializeRutaVisitas($rutaVisitas),
            ];
        }
        return $serializedRutas;
    }
    
    // El método serializeTours() espera un array de tours
    private function serializeTours(array $tours): array {
        $serializedTours = [];
        foreach ($tours as $tour) {
            $serializedTours[] = [
                'id' => $tour->getId(),
                'fecha_hora' => $tour->getFechaHora()->format('Y-m-d H:i:s'),
                // Agrega más propiedades si es necesario
            ];
        }
        return $serializedTours;
    }

    private function serializeRutaVisitas(array $rutaVisitas): array {
        $serializedRutaVisitas = [];
        foreach ($rutaVisitas as $rutaVisita) {
            $serializedRutaVisitas[] = [
                'id' => $rutaVisita->getId(),
                // Agrega más propiedades si es necesario
            ];
        }
        return $serializedRutaVisitas;
    }

    private function serializeLocalidad(Localidad $localidad): array {
        return [
            'id' => $localidad->getId(),
            'nombre' => $localidad->getNombre(),
            // Agrega más propiedades si es necesario
        ];
    }
    
    private function serializeProvincia(Provincia $provincia): array {
        return [
            'id' => $provincia->getId(),
            'nombre' => $provincia->getNombre(),
            // Agrega más propiedades si es necesario
        ];
    }
}
