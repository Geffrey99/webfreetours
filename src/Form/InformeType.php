<?php

namespace App\Form;
use App\Entity\Informe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
USE Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class InformeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('imagen', FileType::class, [
            'label' => 'Imagen (JPG, JPEG, PNG)',
            'mapped' => false, // No mapear directamente a la propiedad imagen de la entidad
            'required' => true, // Si la imagen no es obligatoria
        ])
        ->add('observaciones', TextareaType::class, [
            'label' => 'Observaciones',
            'required' => true, // Puedes ajustar esto según tus necesidades
        ])
        ->add('recaudacion', null, [
            'label' => 'Recaudación', // Puedes ajustar la etiqueta según tus necesidades
            'required' => true, // Hacer que este campo sea obligatorio
        ])
        ->add('cod_tour', EntityType::class, [
            'class' => 'App\Entity\Tour',
            'choice_label' => 'id', // O cualquier propiedad que desees mostrar en el desplegable
            'placeholder' => 'Selecciona un Tour',
            // 'required' => false, // Esto permite que el campo sea nulo
            // 'disabled' => true, // Mantén esta opción
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Informe::class,
        ]);
    }
}
