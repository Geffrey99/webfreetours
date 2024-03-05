<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use App\Entity\Ruta;
use App\Entity\Tour;
Use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\EA;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\TextAlign;




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
                ->setBasePath('public/img/visitas/') // Asegúrate de que esta ruta sea accesible públicamente
                ->setUploadDir('public/public/img/visitas/'), 
        TextEditorField::new('punto_inicio'),
        IntegerField::new('participantes'),
        DateTimeField::new('fecha_inicio'),
        CollectionField::new('rutaVisitas')
            ->setLabel('Visitas')
            ->onlyOnDetail() // Esto mostrará las visitas solo en la página de detalles
    ];
}


public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action
                    ->linkToRoute('app_crear_ruta', []);
                   
            })
            ->disable(Action::EDIT);
            // ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
            //     return $action
            //         ->linkToRoute('app_editar_ruta', []);
            // });
    }



public function configureCrud(Crud $crud): Crud
{
    return $crud
       
        ->setPaginatorPageSize(5)
        
        ->setPaginatorRangeSize(4)
       
        ->setPaginatorFetchJoinCollection(true)
       

       
    ;
}

// public function createEntityFormBuilder($entityFqcn, $formOptions): FormBuilder
//     {
//         $formBuilder = parent::createEntityFormBuilder($entityFqcn, $formOptions);
//         $this->overrideTemplate('new', 'crear_ruta/index.html.twig');
//         return $formBuilder;
//     }

}