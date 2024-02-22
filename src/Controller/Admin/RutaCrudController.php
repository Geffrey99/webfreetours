<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use App\Entity\Ruta;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EaseCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\JsonField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class RutaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ruta::class;
    }

    public function configureFields(string $pageName): iterable
{
    return [
        IdField::new('id')->onlyOnDetail(),
        TextField::new('nombre'),
        TextEditorField::new('descripcion'),
        ImageField::new('foto')
                ->setBasePath($this->getParameter('fotos_visitas')) // Asegúrate de que esta ruta sea accesible públicamente
                ->setUploadDir($this->getParameter('fotos_visitas')), 
        TextEditorField::new('punto_inicio'),
        IntegerField::new('participantes'),
        DateTimeField::new('fecha_inicio'),
        // JsonField::new('programacion'),

        // ... otros campos ...
    ];
}

// public function configureActions(Actions $actions):Actions {
//     return $actions
//     ->add(Crud::PAGE_INDEX, Action::DETAIL)
// }


    // ... el resto del código ...

  
        // ... el resto del código ...
    
public function configureActions(Actions $actions): Actions
{
    // $create = Action::new('create', 'Crear Ruta')
    //     ->setTemplatePath('crear_ruta/index.html.twig') // Usa la ruta correcta a tu plantilla
    //     ->setCssClass('btn btn-success')
    //     ->linkToCrudAction('new');

    return $actions
        ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action){
            return $action->linkToRoute('app_crear_ruta', []);
        }); // Agrega la acción personalizada al índice
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

// public function createEntityFormBuilder($entityFqcn, $formOptions): FormBuilder
//     {
//         $formBuilder = parent::createEntityFormBuilder($entityFqcn, $formOptions);
//         $this->overrideTemplate('new', 'crear_ruta/index.html.twig');
//         return $formBuilder;
//     }

}