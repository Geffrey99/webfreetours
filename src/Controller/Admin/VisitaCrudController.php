<?php

namespace App\Controller\Admin;

use App\Entity\Visita;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
class VisitaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Visita::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            AssociationField::new('cod_localidad')
                ->setLabel('Localidad'),
            TextField::new('nombre'),
            TextEditorField::new('descripcion'),
            
            ImageField::new('foto')
                ->setBasePath('public/img/visitas/')
                ->setUploadDir('public/public/img/visitas/'),
            
            TextField::new('gps'),
        
        
            ];
    }
    
}
