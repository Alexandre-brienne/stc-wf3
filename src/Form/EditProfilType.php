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


class EditProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
     
            ->add('nom', textType::class)
            ->add('prenom', textType::class )
            ->add('email', textType::class)
            ->add('sexe',textType::class)
            ->add('recherche',textType::class)
            ->add('situation',textType::class)
            ->add('profession',textType::class)
            ->add('ville')
            ->add('dapartement')
            ->add('taille')
            ->add('cheveux')
            ->add('astrologique')
            ->add('categories',EntityType::class,[
                'class' => Categories::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
