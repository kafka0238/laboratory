<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customer', TextType::class, [
                'required' => true,
                'label'  => 'Заказчик:',
            ])
            ->add('date', DateType::class, [
                'required' => true,
                'label'  => 'Дата:',
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
            'data_class' => Order::class,
        ]);
    }
}
