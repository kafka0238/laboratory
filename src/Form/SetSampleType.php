<?php

namespace App\Form;

use App\Entity\Container;
use App\Entity\Laboratory;
use App\Entity\Material;
use App\Entity\SetSample;
use App\Entity\StorageMethod;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SetSampleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $setSample = $options['data'];
        $builder
            ->add('lable', TextType::class, [
                'required' => true,
                'label'  => 'Этикетка',
            ])
            ->add('id_material', ChoiceType::class, [
                'choices' => $setSample->getMaterials(),
                'choice_value' => 'id',
                'choice_label' => function(?Material $material) {
                    return $material ? strtoupper($material->getId()) : '';
                },
                'attr' => ['value' => 2],
                'label'  => 'Материал:',
            ])
            ->add('id_container', ChoiceType::class, [
                'choices' => $setSample->getContainers(),
                'choice_value' => 'id',
                'choice_label' => function(?Container $container) {
                    return $container ? strtoupper($container->getId()) : '';
                },
                'attr' => ['value' => 2],
                'label'  => 'Контейнер:',
            ])
            ->add('id_storage_method', ChoiceType::class, [
                'choices' => $setSample->getStorageMethods(),
                'choice_value' => 'id',
                'choice_label' => function(?StorageMethod $storageMethod) {
                    return $storageMethod ? strtoupper($storageMethod->getId()) : '';
                },
                'attr' => ['value' => 2],
                'label'  => 'Способ хранения:',
            ])
            ->add('id_laboratory', ChoiceType::class, [
                'choices' => $setSample->getLaboratories(),
                'choice_value' => 'id',
                'choice_label' => function(?Laboratory $laboratory) {
                    return $laboratory ? strtoupper($laboratory->getId()) : '';
                },
                'attr' => ['value' => 2],
                'label'  => 'Лаборатория:',
            ])
            ->add('submit', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SetSample::class,
        ]);
    }
}
