<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tour;
use App\Entity\UserTour;
use App\Entity\Informe;
use App\Entity\Ruta;
use App\Entity\User;
use App\Controller\Api\DevueltaRoute;
use App\Repository\InformeRepository;
use App\Form\InformeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class GuideController extends AbstractController
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


    #[Route('/guide', name: 'app_guide')]
    public function index(): Response
    {

        $response = $this->devueltaRoute->uploadCreateRoute(new Request(), $this->entityManager);
        $rutas = json_decode($response->getContent(), true);
      
        return $this->render('guide/index.html.twig', [
            'controller_name' => 'GuideController',
            'rutas'=> $rutas
        ]);  
    }


#[Route('/guide/tours-asignados', name: 'app_guide_tours_asignados')]
public function toursAsignados(Request $request): Response
{
    $user = $this->getUser();

    if (in_array('ROLE_GUIDE', $user->getRoles(), true)) {
        $tours = $this->entityManager->getRepository(Tour::class)->findBy(['id_guide' => $user->getId()]);

        $userTours = [];
        
        foreach ($tours as $tour) {
            $userTours[] = $this->entityManager->getRepository(UserTour::class)->findBy(['cod_tour' => $tour->getId()]);
        }

        $form = $this->createForm(InformeType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('cod_tour')->isDisabled()) {
                // Obtener el valor del campo directamente de la configuración del formulario
                $tour = $form->getConfig()->getOption('data');
            } else {
                // Obtener el valor del campo del formulario
                $tourId = $form->get('cod_tour')->getData();
                $tour = $this->entityManager->getRepository(Tour::class)->find($tourId);
            }

            $existingInforme = $this->entityManager->getRepository(Informe::class)->findOneBy(['cod_tour' => $tour]);
            if ($existingInforme) {

                 return $this->redirectToRoute('app_guide_informe');

               
            }
          
            $informe = new Informe();
            $informe->setCodTour($tour);
            $informe->setObservaciones($form->get('observaciones')->getData());
            $informe->setRecaudacion($form->get('recaudacion')->getData());

            $imagenFile = $form->get('imagen')->getData();
            if ($imagenFile) {
                $imagenFileName = $this->handleImageUpload($imagenFile);
                $informe->setImagen($imagenFileName);
            }
                $this->entityManager->persist($informe);
                $this->entityManager->flush();

                $this->addFlash('success', 'Informe creado con éxito.');

            
        }

        return $this->render('guide/tours_asignados.html.twig', [
           
            'tours' => $tours,
            'userTours' => $userTours,
            'form' => $form->createView(),
        ]);
    } else {
        return $this->redirectToRoute('app_home');
    }
}


#[Route('/misInformes', name: 'mis_informes')]
public function misInformes(InformeRepository $informeRepository): Response
{
   
    $user = $this->getUser();

        if ($user && in_array('ROLE_GUIDE', $user->getRoles(), true)) {
            $toursAsignados = $this->entityManager->getRepository(Tour::class)->findBy(['id_guide' => $user->getId()]);
            
            $informesUsuario = [];
            foreach ($toursAsignados as $tour) {
                $informe = $informeRepository->findOneBy(['cod_tour' => $tour->getId()]);
                if ($informe) {
                    $informesUsuario[] = $informe;
                }
            }

            return $this->render('guide/informesTours.html.twig', [
                'informesUsuario' => $informesUsuario,
            ]);
        }

        // Redirigir si el usuario no está autenticado o no es un guía
        return $this->redirectToRoute('app_home');
    }




private function handleImageUpload(UploadedFile $file): string
{
    $fileName = md5(uniqid()) . '.' . $file->guessExtension();
    $file->move($this->getParameter('fotos_visitas'), $fileName);

    return $fileName;
}


#[Route('/guide/informe/formulario/{tourId}', name: 'app_guide_informe_formulario')]
public function formularioInforme(Request $request, int $tourId): Response
{
    $user = $this->getUser();

    if (in_array('ROLE_GUIDE', $user->getRoles(), true)) {
        $tour = $this->entityManager->getRepository(Tour::class)->find($tourId);

        if ($tour && $tour->getFechaHora() < new \DateTime()) {
            $informe = new Informe();
            $informe->setCodTour($tour);

            $form = $this->createForm(InformeType::class, $informe);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $tourId = $request->request->get('informe')['cod_tour'];
                $tour = $this->entityManager->getRepository(Tour::class)->find($tourId);
    
                // Asignar el tour al formulario Informe
                $informe->setCodTour($tour);

                $this->entityManager->persist($informe);
                $this->entityManager->flush();

                $this->addFlash('success', 'Informe creado con éxito.');

                
            }

            return $this->render('guide/informe.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            $this->addFlash('error', 'No se puede crear un informe para este tour.');
           
        }
    } else {
        return $this->redirectToRoute('app_home');
    }
}



#[Route('/pasarLista', name: 'app_pasar_lista')]
public function PasarLista(Request $request): Response
{
    $user = $this->getUser();

    if (in_array('ROLE_GUIDE', $user->getRoles(), true)) {
        $today = new \DateTime();
        $today->setTime(0, 0, 0);

        $tours = $this->entityManager->getRepository(Tour::class)->findAll();
        $userTours = [];

        foreach ($tours as $tour) {
            // Añade el tour solo si es de la fecha actual
            if ($tour->getFechaHora()->format('Y-m-d') == $today->format('Y-m-d')) {
                $tourUserTours = $this->entityManager->getRepository(UserTour::class)->findBy([
                    'cod_tour' => $tour->getId(),
                ]);

                $userTours[] = [
                    'tour' => $tour,
                    'userTours' => $tourUserTours,
                ];
            }
        }

        return $this->render('guide/pasarLista.html.twig', [
            'userTours' => $userTours,
            'today' => $today,
        ]);
    } else {
        return $this->redirectToRoute('app_home');
    }
}
}