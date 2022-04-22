<?php

namespace App\Form;

use App\Entity\ContentEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Form\TextFieldFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('textFields', CollectionType::class, [
                'entry_type' => TextFieldFormType::class,
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'entry_options' => [
                   
                    'label' => 'New paragraph'
                   
                ],
                
                
                
            ])
            ->add('sectionContent', ChoiceType::class, [
                'placeholder' => '-- Select a section --',
                'choices' => [
                    'Headline' => 'headline',
                    'Block 1' => 'block-1',
                    'Block 2' => 'block-2',
                    'Block 3' => 'block-3'
                ]
            ])
            ->add('pageContent', ChoiceType::class, [
                'placeholder' => '-- Select a page --',
                'choices' => [
                    
                    'Home' => 'home',
                    'Bio' => 'bio',
                    'Music' => 'music',
                    'Galery' => 'gallery',
                    'Videos' => 'video',
                    'Shows' => 'shows',
                    'Projects' => 'projects',
                    'Contact' => 'contact',
                    'My listenings' => 'listenings'
                ]
            ])
            ->add('classContent')
            ->add('idContent')
            ->add('positionContent')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContentEntity::class,
        ]);
    }
}
