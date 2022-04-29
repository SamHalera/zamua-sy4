<?php

namespace App\Form;

use App\Entity\ProjectTranslation;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProjectTranslationFormType extends AbstractType
{

    
    
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('language', LanguageType::class, [
                'choice_translation_domain' => true,
            ])
            ->add('mainTitleTrans', TextType::class, [
                'label' => 'Main title translation'
            ])
            ->add('contentTrans',CKEditorType::class,[
                'config_name' => 'main_config',
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field is mandatory!'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProjectTranslation::class,
        ]);
    }
}
