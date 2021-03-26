<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Contacts;
use App\Entity\Missions;
use App\Entity\Targets;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddMissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('country')
            ->add('type')
            ->add('status')
            ->add('startDate')
            ->add('endDate')
            ->add('agents', EntityType::class, [
                'class' => Agents::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('skills')
            ->add('contacts', EntityType::class, [
                'class' => Contacts::class,
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
            ->add('targets', EntityType::class, [
                'class' => Targets::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('hideouts')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Missions::class,
        ]);
    }
}
