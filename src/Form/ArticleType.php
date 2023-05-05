<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', null, [
                'label'=> "Titre de l'article"
            ])
            ->add('textAppercu', null, [
                'label'=> "Texte d'apperçu"
            ])
            ->add('textIntroductif', null, [
                'label'=> "Introduction de l'article"
            ])
            ->add('detail')
            ->add('photo', FileType::class,[
                'label' => "Ajouter une image",
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
            ->add('dateExpiration', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required'=>false
            ])
            ->add('isPrincipal', null, [
                'label'=>"Est l'article principal",
                'attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
        ;
//            ->add('isActif')
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('createdBy')
//            ->add('updatedBy')
//            ->add('siteWeb')
//            ->add('annee')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
