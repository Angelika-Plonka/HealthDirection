<?php

namespace App\Form;

use App\Entity\Fitness;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FitnessType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('weight', null, ['label' => 'fitness.field.weight'])
            ->add('height', null, ['label' => 'fitness.field.height'])
            ->add('belly', null, ['label' => 'fitness.field.belly'])
            ->add('hips', null, ['label' => 'fitness.field.hips'])
            ->add('waist', null, ['label' => 'fitness.field.waist'])
            ->add('bicep', null, ['label' => 'fitness.field.bicep'])
            ->add('chest', null, ['label' => 'fitness.field.chest'])
            ->add('activity', ChoiceType::class, [
                'label' => 'fitness.activity.label',
                'choices' => Fitness::getTypeActivity(),
                'expanded' => false,
                'multiple' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fitness::class,
        ]);
    }

}
