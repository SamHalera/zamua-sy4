<?php

namespace App\Form;

use App\Entity\Playlist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class PlaylistFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'label_attr' => [
                    'class' => 'font-size-l'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field is mandatory!'
                    ])
                ]

            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('url', TextType::class)
            ->add('iframe', TextareaType::class, [
                'label' => 'Put the embedded iframe of your playlist'
            ]) 
            // ->add('createdAt')
            // ->add('updatedAt')
            ->add('coverImage', FileType::class, [
                'attr' => [
                    'accept' => 'image/*',
                ],
                'label' => 'Upload an image cover',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new All([
                        new File(
                            [
                                'maxSize' => '1M',
                                'mimeTypes' => [
                                    'image/jpeg',
                                    'image/png',
                                ],
                                'mimeTypesMessage' => 'Invalid file. Only JPEG, JPG or PNG are accepted!'
                            ],
                        ),
                    ]),
                    
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Playlist::class,
        ]);
    }
}
