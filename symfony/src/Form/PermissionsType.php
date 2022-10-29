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
            ->add('drinkSales', CheckboxType::class, ['label' => 'Vente de boissons', 'required' => false, 'label_attr' => ['class' => 'checkbox-switch']])
            ->add('foodSales', CheckboxType::class, ['label' => 'Vente de nourriture', 'required' => false, 'label_attr' => ['class' => 'checkbox-switch']])
            ->add('membersStatistics', CheckboxType::class, ['label' => 'Statistiques de membres', 'required' => false, 'label_attr' => ['class' => 'checkbox-switch']])
            ->add('membersSubscriptions', CheckboxType::class, ['label' => 'Abonnements des membres', 'required' => false, 'label_attr' => ['class' => 'checkbox-switch']])
            ->add('paymentSchedules', CheckboxType::class, ['label' => 'Calendriers de paiement', 'required' => false, 'label_attr' => ['class' => 'checkbox-switch']])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PermissionsList::class,
        ]);
    }
}
