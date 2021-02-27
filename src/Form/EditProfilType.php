<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;


class EditProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom', textType::class)
            ->add('prenom', textType::class)
            ->add('email', textType::class)
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
            ->add('dapartement', textType::class)
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
                'multiple' => true,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
