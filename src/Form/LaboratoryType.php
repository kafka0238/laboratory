<?php

namespace App\Form;

use App\Entity\Laboratory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LaboratoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pm', TextType::class, [
                'required' => true,
                'label'  => 'PM:',
            ])
            ->add('salary_pm', TextType::class, [
                'required' => true,
                'label'  => 'Зарплата PM:',
            ])
            ->add('pi', TextType::class, [
                'required' => true,
                'label'  => 'PI:',
            ])
            ->add('salary_pi', TextType::class, [
                'required' => true,
                'label'  => 'Зарплата PI:',
            ])
            ->add('location', TextType::class, [
                'required' => true,
                'label'  => 'Местоположение:',
            ])
            ->add('city', TextType::class, [
                'required' => true,
                'label'  => 'Город:',
            ])
            ->add('cost', TextType::class, [
                'required' => true,
                'label'  => 'Стоимость обработки случая:',
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Laboratory::class,
        ]);
    }
}
