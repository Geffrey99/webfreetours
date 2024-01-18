<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class AppController extends AbstractController
 {

    #[Route('/', name:'home')]

    public function homepage() : Response {

        return $this->render('home.html.twig', [
            'titulo' => 'FreeTours',
            'home' => 'Pagina Home'
        ]);
    }

    

}