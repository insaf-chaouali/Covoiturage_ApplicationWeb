<?php

namespace App\Form;

use App\Entity\Feedback;
use App\Entity\Passager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('emetteur')
            ->add('receveur')
            ->add('note')
            ->add('commentaire')
            ->add('datefeedback', null, [
                'widget' => 'single_text',
            ])
            ->add('emetteurPassager', EntityType::class, [
                'class' => Passager::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);
    }
}
