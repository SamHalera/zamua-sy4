<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\ProjectMember;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\ProjectMemberRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;


class ProjectFormType extends AbstractType
{

    private $projectMemberRepository;

    public function __construct(ProjectMemberRepository $projectMemberRepository)
    {
        $this->projectMemberRepository = $projectMemberRepository;    
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mainTitle')
            ->add('firstTitle')
            ->add('secondTitle')
            ->add('priority')
            ->add('members', EntityType::class, [
                'class' => ProjectMember::class,
                'multiple' => true,
                'choices' => $this->projectMemberRepository
                    ->findAllIdAscending()
            ])
            ->add('content', CKEditorType::class,[
                'config_name' => 'main_config'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }


}
