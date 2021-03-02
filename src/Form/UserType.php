<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Categories;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('roles')
            ->add('password')
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('sexe')
            ->add('point')
            ->add('date_inscription')
            ->add('date_naissance')
            ->add('date_connexion')
            ->add('recherche')
            ->add('situation')
            ->add('profession')
            ->add('ville')
            ->add('dapartement')
            ->add('image_fond')
            ->add('taille')
            ->add('cheveux')
            ->add('astrologique')
            ->add('amis_id')
            ->add('categories')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
