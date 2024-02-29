<?php
namespace App\Form;

use App\Entity\User;
use App\Entity\Tour;
use App\Entity\UserTour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;


class ReservarFormTour extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cod_user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nombre',
            ])
            ->add('cod_tour', EntityType::class, [
                'class' => Tour::class,
                'choice_label' => 'id',
            ])
            ->add('fecha_reserva', DateTimeType::class)
            ->add('asistentes', IntegerType::class) // Agregar el campo "asistentes"
            ->add('num_gente_reserva', IntegerType::class) // Agregar el nuevo campo
            ->add('save', SubmitType::class, ['label' => 'Reservar Tour'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserTour::class,
        ]);
    }
}
