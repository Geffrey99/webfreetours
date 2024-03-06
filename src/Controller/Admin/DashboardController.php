<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use App\Entity\Provincia;
use App\Entity\Localidad;
use App\Entity\Ruta;
use App\Entity\Visita;
use App\Entity\Tour;
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
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PasswordField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\DashboardControllerInterface;
use Symfony\Component\HttpFoundation\Request; 
use App\Repository\UserRepository;
use App\Repository\RutaRepository;
use App\Repository\VisitaRepository;
use App\Repository\LocalidadRepository;
use App\Repository\ProvinciaRepository;
use App\Repository\TourRepository;
use App\Repository\LocalitidadRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

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
        yield MenuItem::linkToDashboard('Home', 'fa fa-home', 'admin');
        yield MenuItem::section('Gestión de datos');
        yield MenuItem::linkToCrud('Usuarios', 'fas fa-users', User::class);
        yield MenuItem::section('Gestión de tours');
        // yield MenuItem::linkToRoute('CrearRuta', 'fa fa-edit', 'app_crear_ruta');
        yield MenuItem::linkToCrud('Rutas', 'fas fa-route', Ruta::class);
      //  yield MenuItem::linkToRoute('Editar Ruta', 'far fa-route', 'app_editar_ruta');
        yield MenuItem::linkToCrud('Visitas', 'fa fa-building', Visita::class);
        yield MenuItem::linkToCrud('Tours', 'fa fa-map', Tour::class);
        yield MenuItem::linkToRoute('Planificacion', 'fa-regular fa-calendar', 'app_calendar');
        yield MenuItem::section('Localización');
        yield MenuItem::linkToCrud('Provincias', 'fas fa-map-marked-alt', Provincia::class);
        yield MenuItem::linkToCrud('Localidades', 'fas fa-location', Localidad::class);
        // yield MenuItem::section('Gestión de reservas');
        yield MenuItem::section('Otra página');
     
        
       
    }

    public function configureActions(): Actions 
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);

    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // $Foto = $user->getFoto();

        return parent::configureUserMenu($user)
          ->setName($user->getNombre() . ' /' . $user->getEmail() . '');
            // ->displayUserName(true) // Muestra el nombre del usuario
            // ->setAvatarUrl('public/img/perfil/' . $Foto);
            // // ->displayUserAvatar(true) // Muestra la imagen del usuario
            // //  ->setavatarEmail($user->getEmail())
            // ->addMenuItems([
            //     MenuItem::linkToRoute('My Profile', 'fa fa-id-card', '...', ['...' => '...']),
            //     MenuItem::linkToRoute('Settings', 'fa fa-user-cog', '...', ['...' => '...']),
            //     MenuItem::section(),
            //     MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            // ]);
    }
    
    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('css/admin.css');
    }



    #[Route('/edit-route', name: 'edit-route')]
    public function editarRuta(EntityManagerInterface $entityManager, Request $request, UserRepository $userRepository, SerializerInterface $serializer/*, $id*/): Response
    {
        $id = $request->query->get('id');
        $route = $entityManager->getRepository(Ruta::class)->find($id);
        // dd(json_decode($route->getProgramation()));
        $fechaInicio = $serializer->normalize($route->getFechaInicio(), null, [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s']);
          $fechaFin = $serializer->normalize($route->getFechaFin(), null, [DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s']);
        return $this->render('crear_ruta/editar_ruta.html.twig', [
            'id' => $id,
            'route' => $route,
           // 'programations' => json_decode($route->getProgramation()),
            // 'localities' => $entityManager->getRepository(Localidad::class)->findAll(),
            // 'guides' => $entityManager->getRepository(User::class)->findByRoles(['ROLE_GUIDE'])
        ]);
    }

    #[Route('/mostrar-imagen/{nombreImagen}', name: 'mostrar_imagen')]
public function mostrarImagen($nombreImagen)
{
    $rutaImagen = $this->getParameter('fotos_visitas').'/'.$nombreImagen;

    return new Response(file_get_contents($rutaImagen), 200, [
        'Content-Type' => 'image/*',
        'Content-Disposition' => 'inline; filename="'.$nombreImagen.'"',
    ]);
}
}
