<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
//            ->add('roles')
//            ->add('password')
            ->add('nom', null, [
                'required'=>true
            ])
            ->add('prenom')
            ->add('sexe', ChoiceType::class, [
                'choices'=>[
                    'Féminin'=>'Feminin',
                    'Masculin'=>'Masculin'
                ]
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required'=>true
            ])
            ->add('type', ChoiceType::class, [
                'label'=>"Type d'utilisateur",
                'required'=>true,
                'choices'=>[
                    'Administrateur'=>'Administrateur',
                    'Visiteur'=>'Visiteur'
                ]
            ])
            ->add('pseudo')
//            ->add('isActif')
            ->add('profession')
            ->add('fonction')
            ->add('service')
            ->add('photo', FileType::class,[
                'label' => "Photo",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Entrer une image valide',
                    ])
                ],
            ])
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('dateDerniereConnexion')
//            ->add('createdBy')
//            ->add('updatedBy')
//            ->add('annee')
//            ->add('siteWeb')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
