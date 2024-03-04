<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
USE App\Entity\Ruta;
use App\Entity\Tour;
use App\Entity\User;
use App\Entity\UserTour;
use App\Entity\Valoracion;
use App\Repository\ValoracionRepository;
use App\Repository\UserTourRepository;
use Symfony\Component\Security\Core\Security;
use App\Form\ReservarFormTour;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
USE App\Controller\Api\DevueltaRoute;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
USE Symfony\Component\HttpFoundation\JsonResponse;

class ClienteController extends AbstractController
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
    

    #[Route('/cliente', name: 'app_cliente')]
    public function index(): Response
    {
        return $this->render('cliente/index.html.twig', [
            'controller_name' => 'ClienteController',
        ]);
    }




    #[Route('/verRutas', name: 'verRutas')]
    public function verRutas(): Response
    {
        //obtener la respuesta
        $response = $this->devueltaRoute->uploadCreateRoute(new Request(), $this->entityManager);

        // Decodificar el contenido JSON
        $rutas = json_decode($response->getContent(), true);

        return $this->render('cliente/rutas.html.twig', [
            'rutas' => $rutas,
        ]);
    }



    #[Route('/ruta/{id}/tours', name: 'ruta_tours')]
    public function showTours($id): Response
    {
      $ruta = $this->getDoctrine()->getRepository(Ruta::class)->find($id);

     if (!$ruta) {
        throw $this->createNotFoundException('No se encontró la ruta con id '.$id);
      }

      $tours = $ruta->getTours();

     return $this->render('cliente/tours.html.twig', [
          'tours' => $tours,
       ]);
    }



  #[Route('/reservar/{tourId}', name: 'reservar_tour')]
    public function reservar(Request $request, $tourId, UserInterface $user): Response 
    {
        // Obtener el tour según el ID proporcionado
        $tour = $this->entityManager->getRepository(Tour::class)->find($tourId);

        if (!$tour) {
            throw $this->createNotFoundException('Tour no encontrado');
        }

        $visitas = [];
        foreach ($tour->getCodRuta()->getRutaVisitas() as $rutaVisita) {
            $visitas[] = $rutaVisita->getCodVisita();
        }
      

      
        $userTour = new UserTour();
        $userTour->setCodUser($user);
        $userTour->setFechaReserva(new \DateTime());
      
        $form = $this->createForm(ReservarFormTour::class, $userTour);
        $form->get('num_gente_reserva')->setData('0');
      
        $form->handleRequest($request);

        // Si el formulario se envía y es válido
        if ($form->isSubmitted() && $form->isValid()) {
            $userTour->setCodTour($tour);
            $this->entityManager->persist($userTour);
            $this->entityManager->flush();

            return $this->redirectToRoute('verReservas');
        }

       
        return $this->render('cliente/tours.html.twig', [
            'form' => $form->createView(),
            'tour' => $tour, 
            'ruta' => $tour->getCodRuta(),
            'visitas' => $visitas, 
        ]);
    }


  
    #[Route('/misReservas', name: 'verReservas')]
  public function verReservas(UserTourRepository $userTourRepository, ValoracionRepository $valoracionRepository, UserInterface $user): Response
  {
      // Obtener el ID 
      $userId = $user->getId();
  
      // Verificar 
      if ($userId) {
          // Obtener las reservas del usuario
          $reservasUsuario = $userTourRepository->findBy(['cod_user' => $userId]);

          return $this->render('cliente/reservas.html.twig', [
              'reservasUsuario' => $reservasUsuario,
               
          ]);
      }
  
      return $this->redirectToRoute('app_home');
  }



     #[Route('/procesar-valoracion', name: 'ruta_para_procesar_valoracion')]
    public function procesarValoracion(Request $request, EntityManagerInterface $entityManager, ValoracionRepository $valoracionRepository): Response
    {
         //  ID de la reserva desde el formulario
         $idReserva = $request->request->get('cod_reserva');
        //  ID proporcionado
        $reserva = $this->entityManager->getRepository(UserTour::class)->find($idReserva);
    
        if (!$reserva) {
            throw $this->createNotFoundException('Reserva no encontrada');
        }
    
        $valoracionExistente = $valoracionRepository->findOneBy(['cod_reserva' => $reserva]);

        if ($valoracionExistente) {
            $this->addFlash('error', 'Ya has valorado esta reserva');
            // return new JsonResponse(['error' => 'Ya has valorado esta reserva']);
            return $this->redirectToRoute('app_cliente_valoracion');
           
        }
    
    
        $valoracion = new Valoracion();
        $valoracion->setCodReserva($reserva);
        $valoracion->setNotaGuia($request->request->get('nota_guia'));
        $valoracion->setNotaRuta($request->request->get('nota_ruta'));
        $valoracion->setComentario($request->request->get('comentario'));
    
   
        $entityManager->persist($valoracion);
        $entityManager->flush();
    
       
        $this->addFlash('success', '¡La valoración se ha guardado con éxito!');
    
       
        return $this->redirectToRoute('app_cliente_valoracion');
    }



    #[Route('/verValoraciones', name: 'verValoraciones')]
     public function verValoraciones(UserTourRepository $userTourRepository, ValoracionRepository $valoracionRepository, UserInterface $user): Response
    {
     
        $userId = $user->getId();
    
        if ($userId) {
            $reservasUsuario = $userTourRepository->findBy(['cod_user' => $userId]);
            $valoracionesUsuario = $valoracionRepository->findBy(['cod_reserva' => $reservasUsuario]);
            return $this->render('cliente/valoracion.html.twig', [
                'reservasUsuario' => $reservasUsuario,
                'valoracionesUsuario' => $valoracionesUsuario,
            ]);
        }
    
        //  caso en el que el usuario no está autenticado
        return $this->redirectToRoute('app_home');
    }
    

// #[Route('/verRutas', name: 'verRutas')]
    // public function verRutas(): Response
    // {
    //     $response = $this->forward(DevueltaRoute::class.'::uploadCreateRoute');
    //     $rutas = json_decode($response->getContent(), true);
    // // var_dump($rutas);
    //     return $this->render('cliente/rutas.html.twig', [
    //         'rutas' => $rutas,
    //     ]);
    // }






        }
