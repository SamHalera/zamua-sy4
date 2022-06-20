<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\ZamuaFiles;
use App\Repository\ProjectRepository;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditMediaFormType extends AbstractType
{

    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;    
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isGalleryItem', null, [
                'label' => 'Add to the main gallery'
            ])
            ->add('alt')
            ->add('credit')
            ->add('creditLink')
            ->add('caption')
            ->add('priority')
            ->add('projects', EntityType::class, [
                'label' => 'Add to some projects',
                'class' => Project::class,
                'multiple' => true,
                'choices' => $this->projectRepository->findAll(),
                'required' => false
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
