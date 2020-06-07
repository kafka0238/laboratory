<?php

namespace App\Form;

use App\Entity\StorageMethod;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StorageMethodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label'  => 'Название:',
            ])
            ->add('temp', TextType::class, [
                'required' => true,
                'label'  => 'Температурный режим:',
            ])
            ->add('features', TextareaType::class, [
                'required' => false,
                'label'  => 'Особенности:',
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StorageMethod::class,
        ]);
    }
}
