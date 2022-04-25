<?php

namespace App\Form;


use App\Entity\ZamuaFiles;
use PhpParser\Parser\Multiple;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Mime\MimeTypes;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotNull;

class FileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('newFiles', FileType::class, [
                'attr' => [
                    'accept' => 'image/*',
                    'multiple'=> 'multiple',
                ],
                'label' => 'Upload a file',
                'mapped' => false,
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
                        new NotNull(),
                    ]),
                    
                ],
                'multiple' => true
            ])

            

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ZamuaFiles::class,
        ]);
    }
}
