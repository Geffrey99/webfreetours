<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            TextField::new('email'),
            ArrayField::new('ROLES'),
            BooleanField::new('is_verified'),
            TextField::new('nombre'),
            ImageField::new('foto')
                ->setBasePath('public/img/perfil/')
                ->setUploadDir('public/public/img/perfil/'),
        
        ];
    }
    

    // public function configureActions(Actions $actions): Actions
    // {
    //     return parent::configureActions($actions)
    //         ->disable(Action::DETAIL);
    // }
}
