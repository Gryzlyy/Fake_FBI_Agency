<?php

namespace App\Form;

use App\Entity\Missions;
use App\Entity\Targets;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddTargetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName')
            ->add('firstName')
            ->add('birthDate')
            ->add('codeName')
            ->add('nationality')
            ->add('missions', EntityType::class, array(
                'class' => Missions::class,
                'by_reference' => false,
                'multiple' => true,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Targets::class,
        ]);
    }
}
