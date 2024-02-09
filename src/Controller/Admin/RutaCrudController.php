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



class RutaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ruta::class;
    }

    public function configureFields(string $pageName): iterable
{
    return [
        IdField::new('id'),
        TextField::new('nombre'),
        TextEditorField::new('descripcion'),
        // ImageField::new('imagen'),
        TextEditorField::new('punto_inicio'),
        TextField::new('participantes'),
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
    
public function configureActions(Actions $actions): Actions {
    $create = Action::new('create', 'Crear Ruta')
    // Especifica la plantilla que quieres mostrar
    ->setTemplatePath('crear_ruta/index.html.twig')
    // Opcionalmente, puedes cambiar el color del botón
    ->setCssClass('btn btn-success')
    ->linkToCrudAction('new');

// Devuelve las acciones modificadas
return $actions
    // Reemplaza la acción CREATE original por la personalizada
    ->remove(Crud::PAGE_INDEX, Action::NEW)
    ->add(Crud::PAGE_INDEX, $create);
}
}

// public function createEntityFormBuilder($entityFqcn, $formOptions): FormBuilder
//     {
//         $formBuilder = parent::createEntityFormBuilder($entityFqcn, $formOptions);
//         $this->overrideTemplate('new', 'crear_ruta/index.html.twig');


//         return $formBuilder;
//     }

    