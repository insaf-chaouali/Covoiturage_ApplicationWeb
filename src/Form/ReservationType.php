<?php

namespace App\Form;

use App\Entity\Paiement;
use App\Entity\Passager;
use App\Entity\Reservation;
use App\Entity\Trajet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('trajetDescription')
            ->add('dateReservation', null, [
                'widget' => 'single_text',
            ])
            ->add('statut')
            ->add('passager', EntityType::class, [
                'class' => Passager::class,
                'choice_label' => 'id',
            ])
            ->add('trajet', EntityType::class, [
                'class' => Trajet::class,
                'choice_label' => 'id',
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
