<?php

namespace App\Form;

use App\Entity\Slide;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class SlideType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
//            ->add('siteWeb')
//            ->add('annee')
            ->add('photo', FileType::class,[
                'label' => "Image du slide (résolution recommandée: 1920x1150)",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Entrer une image valide',
                    ])
                ],
            ])
            ->add('detail')
//            ->add('isActif')
            ->add('isDescriptionEnabled', null, [
                'label'=>"Afficher le block descriptif"
            ])
            ->add('isTitleEnable', null, [
                'label'=>"Afficher le titre"
            ])
            ->add('isTexteDetailEnabled', null, [
                'label'=>"Afficher le texte de détail"
            ])
            ->add('isBoutonVoirPlusEnabled', null, [
                'label'=>"Afficher le bouton voir+"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Slide::class,
        ]);
    }
}
