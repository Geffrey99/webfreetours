<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Tour;
use App\Entity\UserTour;
use App\Entity\Informe;
use App\Form\InformeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
class GuideController extends AbstractController
{

private $entityManager;

public function __construct(EntityManagerInterface $entityManager)
{ 
    $this->entityManager = $entityManager;
}


    #[Route('/guide', name: 'app_guide')]
    public function index(): Response
    {

        $user = $this->getUser();

        if (in_array('ROLE_GUIDE', $user->getRoles(), true)) {

            $tours = $this->entityManager->getRepository(Tour::class)->findBy(['id_guide' => $user->getId()]);
            // return $this->redirectToRoute('guide_dashboard');
         
            $userTours = [];
            foreach ($tours as $tour) {
                $userTours[] = $this->entityManager->getRepository(UserTour::class)->findBy(['cod_tour' => $tour->getId()]);
            }
        return $this->render('guide/index.html.twig', [
            'controller_name' => 'GuideController',
            'tours'=>$tours,
            'userTours' => $userTours,
        ]);
      }  else {
            return $this->redirectToRoute('app_home');
        }
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
            // $tourId = $form->get('cod_tour')->getData();
            // $tour = $this->entityManager->getRepository(Tour::class)->find($tourId);
            // $existingInforme = $this->entityManager->getRepository(Informe::class)->findOneBy(['cod_tour' => $tour]);

            // if ($existingInforme) {
            //     // Manejar el caso cuando el tour ya tiene un informe
            //     $this->addFlash('error', 'Este tour ya tiene un informe.');
            //     // Puedes redirigir a donde desees o simplemente retornar la respuesta
            //     return new JsonResponse(['error' => 'Este tour ya tiene un informe.'], 400);
            // }
            // Configurar el tour en el bucle para que sea el correcto
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

                // Puedes agregar aquí una lógica para actualizar la página o cargar los datos necesarios
            
            // Puedes agregar aquí una lógica para actualizar la página o cargar los datos necesarios
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

                // Puedes agregar aquí una lógica para actualizar la página o cargar los datos necesarios
            }

            return $this->render('guide/informe.html.twig', [
                'form' => $form->createView(),
            ]);
        } else {
            $this->addFlash('error', 'No se puede crear un informe para este tour.');
            // Puedes manejar el caso cuando la fecha no ha pasado, por ejemplo, mostrando un mensaje en la página
        }
    } else {
        return $this->redirectToRoute('app_home');
    }
}




//     #[Route('/guide', name: 'app_guide')]
// public function index(): Response
// {
//     $user = $this->getUser();

//     if (in_array('ROLE_GUIDE', $user->getRoles(), true)) {
//         // Obtener todos los tours relacionados con el guía
//         $tours = $this->entityManager->getRepository(Tour::class)->findBy(['id_guide' => $user->getId()]);

//         // Cargar información adicional relacionada con los tours y usuarios en una sola consulta
//         $toursWithUserTours = $this->entityManager->getRepository(Tour::class)
//             ->createQueryBuilder('t')
//             ->select('t', 'ut') // Seleccionar el tour y los userTours
//             ->leftJoin('t.userTours', 'ut') // Hacer una LEFT JOIN con userTours
//             ->where('t.id_guide = :guideId')
//             ->setParameter('guideId', $user->getId())
//             ->getQuery()
//             ->getResult();

//         return $this->render('guide/index.html.twig', [
//             'controller_name' => 'GuideController',
//             'tours' => $toursWithUserTours,
//         ]);
//     } else {
//         return $this->redirectToRoute('app_home');
//     }


 /**
     * @Route("/seleccionar-guias", name="seleccionar_guias")
     */
    // public function seleccionarGuias()
    // {
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $userRepository = $entityManager->getRepository('App\Entity\User');

    //     // Seleccionar usuarios con el rol 'ROLE_GUIDE'
    //     $guias = $userRepository->findBy(['roles' => ['ROLE_GUIDE']]);

    //     return $this->render('crear_ruta/index.html.twig', ['guias' => $guias]);
    // }
}