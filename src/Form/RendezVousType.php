<?php

namespace App\Form;

use App\Entity\RendezVous;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezVousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('telephone')
            ->add('dateRendezVous')
            ->add('heureRendezVous')
            ->add('isConfirmer')
            ->add('isAnnuler')
            ->add('isReamenager')
            ->add('hasTakenPlace')
            ->add('isActif')
            ->add('isLu')
            ->add('isRepondu')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('consultant')
            ->add('service')
            ->add('createdBy')
            ->add('updatedBy')
            ->add('siteWeb')
            ->add('annee')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
