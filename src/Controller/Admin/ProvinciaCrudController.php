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
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use App\Entity\Localidad;



class ProvinciaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Provincia::class;
    }



    // Aquí puedes añadir tus métodos personalizados...

//     public function showProvinciasYLocalidades()
//     {
//         $provincias = $this->getDoctrine()->getRepository(Provincia::class)->findAll();

//         foreach ($provincias as $provincia) {
//             echo 'Provincia: ' . $provincia->getNombre() . '<br>';
//             echo 'Localidades: <br>';

//             $localidades = $this->getDoctrine()->getRepository(Localidad::class)->findBy(['provincia' => $provincia]);

//             foreach ($localidades as $localidad) {
//                 echo '- ' . $localidad->getNombre() . '<br>';
//             }

//             echo '<br>';
//         }
//         return $this->render('admin/provlocal.html.twig');
//     }
// }
}