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
        
        TextEditorField::new('programacion'),
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



// public function createEntityFormBuilder($entityFqcn, $formOptions): FormBuilder
//     {
//         $formBuilder = parent::createEntityFormBuilder($entityFqcn, $formOptions);
//         $this->overrideTemplate('new', 'crear_ruta/index.html.twig');
//         return $formBuilder;
//     }

}