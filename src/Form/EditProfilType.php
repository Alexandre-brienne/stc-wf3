<?php

namespace App\Form;


use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\Image;
use App\Entity\Categories;

class EditProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('nom', textType::class)
            ->add('prenom', textType::class)
            ->add('email', textType::class)
            ->add('image_profil',FileType::class,[
                'data_class' => null,
                "label" => "votre image de profil",
                "empty_data" => 'accune image', 
                "required" => false,
                "constraints" => [
                    new Image([
                        // "maxsize" => "10240k",
                        'minWidth' => 200,
                        'maxWidth' => 1000,
                        'minHeight' => 200,
                        'maxHeight' => 1000,
                    ])
                ]

            ])
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                    'Autre' => 'Autre',
                ]
            ])
            ->add('recherche', ChoiceType::class, [
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                    'HommeOuFemme' => 'HommeOuFemme',
                ]
            ])
            ->add('situation', ChoiceType::class, [
                'choices' => [
                    'celibataire' => 'celibataire',
                    'En Couple' => 'En Couple',
                    'Marié' => 'Marié',
                    'Divorcé' => 'Divorcé',
                    "c'est compliqué" => "c'est compliqué",
                ]
            ])
            ->add('profession', textType::class)
            ->add('ville' ,textType::class)
            ->add('dapartement', textType::class,[
                'label' => 'votre departement ?'
            ])
            ->add('taille', textType::class)
            ->add('cheveux' ,textType::class)
            ->add('astrologique', ChoiceType::class, [
                'choices' => [
                    'Bélier' => 'Bélier',
                    'Taureau' => 'Taureau',
                    'Gémeaux' => 'Gémeaux',
                    'Cancer' =>  'Cancer',
                    "Lion" =>  "Lion",
                    "Vierge" => "Vierge",
                    "Balance" =>  "Balance",
                    "Scorpion" =>   "Scorpion",
                    "Sagittaire" =>  "Sagittaire",
                    "Capricorne" =>   "Capricorne",
                    "Verseau" =>    "Verseau",
                    "poissons" =>    "poissons",
                ]
            ])
            ->add('categories', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'name',
                // 'choices' => 'id',
                'multiple' => true,
                'expanded' => true,
            ])
  
            
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
