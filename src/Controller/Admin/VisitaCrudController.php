<?php

namespace App\Controller\Admin;

use App\Entity\Visita;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
    
            // the max number of entities to display per page
            ->setPaginatorPageSize(5)
            // the number of pages to display on each side of the current page
            // e.g. if num pages = 35, current page = 7 and you set ->setPaginatorRangeSize(4)
            // the paginator displays: [Previous]  1 ... 3  4  5  6  [7]  8  9  10  11 ... 35  [Next]
            // set this number to 0 to display a simple "< Previous | Next >" pager
            ->setPaginatorRangeSize(4)
            // ->setAutofocusSearch()
            ->setPaginatorFetchJoinCollection(true)
            // ->setSearchFields(['nombre'])

            // // these are advanced options related to Doctrine Pagination
            // // (see https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/tutorials/pagination.html)
            // ->setPaginatorUseOutputWalkers(true)
            // ->setPaginatorFetchJoinCollection(true)
        ;
    }
    
}
