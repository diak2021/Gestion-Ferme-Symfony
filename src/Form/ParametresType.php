<?php

namespace App\Form;

use App\Entity\Parametres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ParametresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelleStructure', null, [
                'label'=>"Appellation de la structure",
                'required'=>true
            ])
            ->add('telephone', null, [
                'label'=>"N° de téléphone principal",
            ])
            ->add('email', null, [
                'label'=>"Adresse email",
            ])
            ->add('facebook', null, [
                'label'=>"Lien Facebook",
            ])
            ->add('twitter', null, [
                'label'=>"Lien Twitter",
            ])
            ->add('linkdin', null, [
                'label'=>"Lien Linkdin",
            ])
            ->add('youtube', null, [
                'label'=>"Lien Youtube",
            ])
            ->add('isSectionServiceEnabled', null, [
                'label'=>"Afficher la section service",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionEmergencyEnabled', null, [
                'label'=>"Afficher la section urgence",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionAboutEnabled', null, [
                'label'=>"Afficher la section à propos",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionChiffreEnabled', null, [
                'label'=>"Afficher la section statistique",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionCol6_6Enabled', null, [
                'label'=>"Afficher la section col 6-2 (expérience)",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectioncol4ProduitEnabled', null, [
                'label'=>"Afficher la section produits",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isFormRDVenabled', null, [
                'label'=>"Afficher le formulaire de rendez-vous",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionActualiteEnabled', null, [
                'label'=>"Afficher la section actualité",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionTestimonialEnabled', null, [
                'label'=>"Afficher la section témoignage",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionTeamEnabled', null, [
                'label'=>"Afficher la section liste des médecins",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionSlideOutilsEnabled', null, [
                'label'=>"Afficher la section des outils",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionPricingEnabled', null, [
                'label'=>"Afficher la section des prix",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionFAQenabled', null, [
                'label'=>"Afficher la section questions",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionMapsEnabled', null, [
                'label'=>"Afficher la section localisation",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionQuickEmailEnabled', null, [
                'label'=>"Afficher la section envoi Email",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isFacebookEnable', null, [
                'label'=>"Afficher l'icône Facebook",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isTwitterEnabled', null, [
                'label'=>"Afficher l'icône Twitter",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isLinkdinEnabled', null, [
                'label'=>"Afficher l'icône Linkdin",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isYoutubeEnabled', null, [
                'label'=>"Afficher l'icône Youtube",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ],
            ])
            ->add('couleurPrincipale', null, [
                'label'=>"Définir la couleur principal du site en Hexadécimal(ex: #dod4dr)",
            ])
            ->add('plageOuvertureDesLocaux', null, [
                'label'=>"Plage d'ouverture quotidienne des lieux",
            ])
            ->add('isSectionNewsLetterEnabled', null, [
                'label'=>"Afficher le formulaire de newsletter",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('slogan', null, [
                'label'=>"Phrase d'accroche (slogan)",
            ])
            ->add('isPlageOuvertureEnabled', null, [
                'label'=>"Afficher les horaires d'ouverture",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isPhoneNumberEnabled', null, [
                'label'=>"Afficher le numéro de téléphone",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('isSectionDisponibiliteEnabled', null, [
                'label'=>"Afficher le bloc de disponibilité sous le slider",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('emailToAdminAfterNewRDV', null, [
                'label'=>"Envoyer un mail à l'admin après chaque demande de RDV",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('smsToAdminAfterNewRDV', null, [
                'label'=>"Envoyer un SMS à l'admin après chaque demande de RDV",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('emailToClientAfterNewRDV', null, [
                'label'=>"Envoyer un mail au client après sa demande de RDV",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('smsToClientAfterNewRDV', null, [
                'label'=>"Envoyer un SMS au client après sa demande de RDV",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('emailToAdminAfterNewMailing', null, [
                'label'=>"Envoyer un mail à l'admin après chaque mail reçu",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('emailToClientAfterNewMailing', null, [
                'label'=>"Envoyer un mail au client après son envoi de mail au site",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('emailToAdminAfterNewAddNewsletter', null, [
                'label'=>"Envoyer un mail à l'admin après chaque souscription à la newsletter",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('emailToClientAfterNewAddNewsletter', null, [
                'label'=>"Envoyer un mail au client après sa souscription à la newsletter",
                'label_attr'=>[
                    'class'=>"checkbox-custom"
                ]
            ])
            ->add('siteWeb', null, [
                'label'=>"Site Web Concerné",
            ])
            ->add('logo', FileType::class,[
                'label' => "Logo (résolution recommandée 300x100)",
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
            ->add('favicon', FileType::class,[
                'label' => "Icône du navigateur",
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Parametres::class,
        ]);
    }
}
