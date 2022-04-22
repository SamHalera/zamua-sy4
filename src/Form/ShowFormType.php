<?php


namespace App\Form;

use App\Entity\Show;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;


class ShowFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'You must choose a date for this show!'
                    ])
                ]
            ])
            ->add('name', TextType::class, [
                'required' => false
            ])
            ->add('venue',TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field is mandatory!'
                    ])
                ]
            ])
            ->add('venueUrl',UrlType::class, [
                'required' => false
            ])
            ->add('locationUrl',UrlType::class, [
                'required' => false
            ])
            ->add('ticketUrl',UrlType::class, [
                'required' => false
            ])
            ->add('location', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field is mandatory!'
                    ])
                ]
            ])
            ->add('isPassed')
            ->add('isCancelled')
            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Show::class
        ]);
    }

    
}
