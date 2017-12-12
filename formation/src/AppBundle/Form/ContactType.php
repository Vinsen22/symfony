<?php

namespace AppBundle\Form;

use AppBundle\Entity\Hobby;
use AppBundle\Entity\OperatingSystem;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   /*
            add
                - nom du champ utilise dans la vue
                - type de champ : http://symfony.com/doc/current/reference/forms/types.html
                    contrainte de champs
                       contrainte de validation : https://symfony.com/doc/current/reference/constraints.html


        */
        $builder
            ->add('nom', TextType::class,
                [
                    'constraints'=>[
                        new NotBlank([
                            'message'=> "Vous n'avez pas saisi votre nom "
                        ]),
                        new Length([
                            'min'=>2,
                            'minMessage' => "Votre nom doit comporter deux caractères au minimum"
                        ])
                    ]
                ])
            ->add('prenom',TextType::class)
            ->add('email',EmailType::class)
            /*
             * EntityType : permet de relier un champ à une entité
             * class permet de définir l'entité cible
             * choice_label : choix de la propriété de l'entité à afficher
             * choix de l'affichage
             *      expanded : affichage de plusieurs champs; par défaut false
             *      multiple : sélection de plusieurs champs; par défaut false
             *  combinaisons possible :
             *      liste deroulante : expanded false / multiple false
             *      boutons radio : expanded true / multiple false
             *      cases à cocher : expanded true / multiple true : obligatoire pour les many to many
             */
            ->add('hobbies',EntityType::class,[
                'class'=> Hobby::class,
                'choice_label' => 'nom',
                'expanded'=> true,
                'multiple'=> true,
                'constraints'=> [
                    new Count([
                        'min'=>1,
                        'minMessage'=> "Vous devez saisir minimum un loisir"
                    ])
                ]

            ])
            /**
             * Systeme d'exploitation : bouton radio
             */
            ->add('operating_system',EntityType::class,[
                'class'=> OperatingSystem::class,
                'choice_label'=>'name', // La propriété de la classe qu'on veut afficher
                'expanded'=>true,
                'multiple'=>false,


            ])
            ->add('message',TextareaType::class);
        // On met en commentaire ce qu'on veut pas faire afficher dans le formulaire
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }


}
