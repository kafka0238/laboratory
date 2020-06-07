<?php

namespace App\Form;

use App\Entity\Laboratory;
use App\Entity\Project;
use App\Entity\Thing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $thing = $options['data'];
        $builder
            ->add('id_project', ChoiceType::class, [
                'choices' => $thing->getProjects(),
                'choice_value' => 'id',
                'choice_label' => function(?Project $project) {
                    return $project ? strtoupper($project->getId()) : '';
                },
                'attr' => ['value' => 2],
                'label'  => 'Проект:',
            ])
            ->add('id_laboratory', ChoiceType::class, [
                'choices' => $thing->getLaboratories(),
                'choice_value' => 'id',
                'choice_label' => function(?Laboratory $laboratory) {
                    return $laboratory ? strtoupper($laboratory->getId()) : '';
                },
                'attr' => ['value' => 2],
                'label'  => 'Лаборатория:',
            ])
            ->add('name', TextType::class, [
                'required' => true,
                'label'  => 'Название:',
            ])
            ->add('collection_date', DateType::class, [
                'required' => true,
                'label'  => 'Дата сбора:',
            ])
            ->add('processing_date', DateType::class, [
                'required' => true,
                'label'  => 'Дата обработки:',
            ])
            ->add('clinical_date', TextareaType::class, [
                'required' => false,
                'label'  => 'Клинические данные:',
            ])
            ->add('additionally', TextareaType::class, [
                'required' => false,
                'label'  => 'Дополнительно:',
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Thing::class,
        ]);
    }
}
