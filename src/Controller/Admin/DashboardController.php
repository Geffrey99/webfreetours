<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Provincia;
use App\Entity\Localidad;
use App\Entity\Ruta;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN', statusCode: 403, exceptionCode: 10010)]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

         return $this->render('admin/index.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Webfreetours');
    }

 

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Home', 'fa fa-home');
        yield MenuItem::section('Gestión de datos');
        yield MenuItem::linkToCrud('Usuarios', 'fas fa-users', User::class);
        yield MenuItem::section('Gestión de rutas');
        yield MenuItem::linkToCrud('Rutas', 'fas fa-route', Ruta::class);
        yield MenuItem::section('Localización');
        yield MenuItem::linkToCrud('Provincias', 'fas fa-map-marked-alt', Provincia::class);
        yield MenuItem::linkToCrud('Localidades', 'fas fa-location', Localidad::class);
        yield MenuItem::section('Gestión de reservas');
        yield MenuItem::linkToUrl('Otra página', 'fa fa-link', $this->generateUrl('app_crear_ruta') );
        // Add the following line to load another page
       
    }

    public function configureActions(): Actions 
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);

    }




}
