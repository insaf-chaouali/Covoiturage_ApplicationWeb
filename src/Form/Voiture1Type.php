<?php

// src/Form/Voiture1Type.php

namespace App\Form;

use App\Entity\Conducteur;
use App\Entity\Trajet;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Voiture1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque')
            ->add('modele')
            ->add('couleur')
            ->add('immatriculation')
            ->add('conducteurr', EntityType::class, [
                'class' => Conducteur::class,
                'choice_label' => 'id',
            ])
            // Ajout du champ pour les trajets
            ->add('trajets', EntityType::class, [
                'class' => Trajet::class,
                'choice_label' => function (Trajet $trajet) {
                    return $trajet->getPointDepart() . ' → ' . $trajet->getPointArrivee();
                },
                'multiple' => true,  // Permet de sélectionner plusieurs trajets
                'expanded' => true,   // Affiche les trajets sous forme de cases à cocher
                'required' => false, // Rendre ce champ non obligatoire
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
