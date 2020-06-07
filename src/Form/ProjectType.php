<?php

namespace App\Form;

use App\Entity\InclusionCriterion;
use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $project = $options['data'];
        $inclusionCriterion = $project->getInclusionCriterion();
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label'  => 'Название:',
            ])
            ->add('disease', TextareaType::class, [
                'required' => false,
                'label'  => 'Заболевание:',
            ])
            ->add('id_inclusion_criterion', ChoiceType::class, [
                'choices' => $project->getInclusionCriterion(),
                'choice_value' => 'id',
                'choice_label' => function(?InclusionCriterion $inclusionCriterion) {
                    return $inclusionCriterion ? strtoupper($inclusionCriterion->getId()) : '';
                },
                'attr' => ['value' => 2],
                'label'  => 'Критерий включения:',
            ])
            ->add('additionally', TextareaType::class, [
                'required' => false,
                'label'  => 'Дополнительно:',
            ])
            ->add('request', SubmitType::class, [
                'label'  => 'Создать',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
