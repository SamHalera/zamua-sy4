<?php

namespace App\Form;

use App\Entity\ProjectMember;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectMembersFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', null, [
                'attr' => [
                    'class' => 'mb-2'
                ]
            ])
            ->add('lastName', null, [
                'attr' => [
                    'class' => 'mb-2'
                ]
            ])
            ->add('artistName', null, [
                'attr' => [
                    'class' => 'mb-2'
                ]
            ])
            ->add('features', null, [
                'attr' => [
                    'class' => 'mb-2'
                ]
            ])
            ->add('featuresIt', null, [
                'label' => 'Features (IT)',
                'attr' => [
                    'class' => 'mb-2'
                ]
            ])
            ->add('featuresFr', null, [
                'label' => 'Features (Fr)',
                'attr' => [
                    'class' => 'mb-2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProjectMember::class,
        ]);
    }
}
