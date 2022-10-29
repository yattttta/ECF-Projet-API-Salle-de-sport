<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\UserType;
use App\Form\StructureType;
use App\Form\FranchiseType;

class FinalFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', UserType::class, ['label' => false])
            ->add('structure', StructureType::class, ['label' => false])
            ->add('franchise', FranchiseType::class, ['label' => false])
            ->add('permissions', PermissionsType::class, ['label' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'validation_groups' => 'register'
        ]);
    }
}

