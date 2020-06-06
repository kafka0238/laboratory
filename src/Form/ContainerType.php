<?php

namespace App\Form;

use App\Entity\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContainerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label'  => 'Название:',
            ])
            ->add('volume', NumberType::class, [
                'required' => false,
                'label'  => 'Объем:',
            ])
            ->add('additionally', TextareaType::class, [
                'required' => false,
                'label'  => 'Дополнительно:',
            ])
            ->add('request', SubmitType::class, [
                'label'  => 'Создать',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Container::class,
        ]);
    }
}
