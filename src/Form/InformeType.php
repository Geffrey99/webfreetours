<?php

namespace App\Form;
use App\Entity\Informe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
USE Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class InformeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('imagen', FileType::class, [
            'label' => 'Imagen (JPG, JPEG, PNG)',
            'mapped' => false, // No mapear directamente a la propiedad imagen de la entidad
            'required' => false, // Si la imagen no es obligatoria
        ])
        ->add('observaciones')
        ->add('recaudacion')
        ->add('cod_tour', EntityType::class, [
            'class' => 'App\Entity\Tour',
            'choice_label' => 'id', // O cualquier propiedad que desees mostrar en el desplegable
            'placeholder' => 'Selecciona un Tour',
            // 'disabled' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Informe::class,
        ]);
    }
}
