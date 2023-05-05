<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('service')
            ->add('abrege', null, [
                'label'=>"Abrégé (Titre sur le site)"
            ])
            ->add('icon', null, [
                'label'=>"Icone de présentation (ex: fas fa-pills)"
            ])
            ->add('detail')
            ->add('isTitleEnabled', null, [
                'label'=>"Afficher le titre",
            ])
            ->add('isDescriptionEnabled', null, [
                'label'=>"Afficher la description",
            ])
//            ->add('code')
//            ->add('responsable')
//            ->add('isActif')
//            ->add('createdBy')
//            ->add('updatedBy')
//            ->add('siteWeb')
//            ->add('annee')
//            ->add('createdAt')
//            ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
