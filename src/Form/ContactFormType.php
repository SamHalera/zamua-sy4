<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('senderName', TextType::class, [
                
                'label_attr' => [
                    'class' => 'font-size-l'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Il nome é obbligatorio!'
                    ])
                ]

            ])
            ->add('senderEmail', EmailType::class, [
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'font-size-l'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'L\'indirizzo email é obbligatorio!'
                    ])
                ]
            ])
            ->add('content', TextareaType::class, [
                
                'label_attr' => [
                    'class' => 'font-size-l'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Non dimenticare di scrivere il tuo messaggio!'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
