<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\UserRepository;
use App\Repository\RutaRepository;
class CalendarController extends AbstractController
{
    #[Route('/calendar', name: 'app_calendar')]
    public function index(AuthenticationUtils $authenticationUtils, UserRepository $userRepository): Response
    {

        $guias = $userRepository->findUsersByRole('ROLE_GUIDE');
        return $this->render('calendar/index.html.twig', [
           'guias'=>$guias
        ]);
    }
}
