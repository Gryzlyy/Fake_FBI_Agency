<?php

namespace App\Form;

use App\Entity\Agents;
use App\Entity\Missions;
use App\Entity\Skills;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAgentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName')
            ->add('firstName')
            ->add('codeName')
            ->add('nationality')
            ->add('skills', EntityType::class, array(
                'class' => Skills::class,
                'by_reference' => false,
                'multiple' => true,
            ))
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
            'data_class' => Agents::class,
        ]);
    }
}
