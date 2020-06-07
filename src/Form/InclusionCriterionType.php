<?php

namespace App\Form;

use App\Entity\InclusionCriterion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InclusionCriterionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nationality', TextType::class, [
                'required' => true,
                'label'  => 'Национальность:',
            ])
            ->add('smoking', TextType::class, [
                'required' => true,
                'label'  => 'Курение:',
            ])
            ->add('alcohol', TextType::class, [
                'required' => true,
                'label'  => 'Алкоголь:',
            ])
            ->add('disease', TextareaType::class, [
                'required' => false,
                'label'  => 'Заболевание:',
            ])
            ->add('subtype', TextareaType::class, [
                'required' => false,
                'label'  => 'Подтип:',
            ])
            ->add('stage', TextareaType::class, [
                'required' => false,
                'label'  => 'Стадия:',
            ])
            ->add('treatment', TextareaType::class, [
                'required' => false,
                'label'  => 'Лечение:',
            ])
            ->add('chronic_disease', TextareaType::class, [
                'required' => false,
                'label'  => 'Хронические заболевания:',
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
            'data_class' => InclusionCriterion::class,
        ]);
    }
}
