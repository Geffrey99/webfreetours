<?php

namespace App\Controller\Admin;

use App\Entity\Provincia;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;


class ProvinciaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Provincia::class;
    }

    // Aquí puedes añadir tus métodos personalizados...
}
