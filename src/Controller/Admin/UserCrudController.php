<?php

namespace App\Controller\Admin;

use App\Entity\User;
// use EasyCorp\Bundle\EasyAdminBundle\Field\PasswordField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
// use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
// Remove the conflicting import statement for EasyCorp\Bundle\EasyAdminBundle\Field\PasswordField
// use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
// use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    // private $passwordEncoder;

    // public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    // {
    //     $this->passwordEncoder = $passwordEncoder;
    // }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            TextField::new('email'),
            ArrayField::new('ROLES'),
            // PasswordField::new('password')
            //     ->onlyOnForms()
            //     ->setFormTypeOption('mapped', false) // Evita que el campo modifique directamente la entidad
            //     ->setFormTypeOption('required', false), // No se requiere en el formulario
        
            BooleanField::new('is_verified'),
            TextField::new('nombre'),
            ImageField::new('foto')
                ->setBasePath('public/img/perfil/')
                ->setUploadDir('public/public/img/perfil/'),
        
        ];
    }
    

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(5)
            ->setPaginatorRangeSize(4)
            ->setPaginatorFetchJoinCollection(true)
        ;
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     return parent::configureActions($actions)
    //         ->disable(Action::DETAIL);
    // }
}
