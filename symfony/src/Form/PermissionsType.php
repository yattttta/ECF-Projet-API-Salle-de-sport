<?php

namespace App\Form;

use App\Entity\PermissionsList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('drink_sales', CheckboxType::class, ['label_attr' => ['class' => 'switch-custom']])
            ->add('food_sale')
            ->add('members_statistics')
            ->add('members_subscription')
            ->add('payment_schedules')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PermissionsList::class,
        ]);
    }
}
