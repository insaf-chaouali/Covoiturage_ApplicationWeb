<?php

namespace App\Form;

use App\Entity\Notification;
use App\Entity\Passager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PassagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('adresse')
            ->add('prenom')
            ->add('telephone')
            ->add('email')
            ->add('password')
            ->add('dateInscription', null, [
                'widget' => 'single_text',
            ])
            //->add('avis')
           // ->add('historiqueReservations', null, [
                //'required' => false,])
           // ->add('notifications', EntityType::class, [
               // 'class' => Notification::class,
                //'choice_label' => 'id',
                //'multiple' => true,
          ///  ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Passager::class,
        ]);
    }
}
