<?php

namespace AccueilBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationCampagneType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder->add('entlbContexte', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'Entretien professionnel bisanuel' => 'bisanuel',
                'Entretien proposé suite à une reprise d’activité   (maternité, congé parental, longue maladie, …)' => 'reprise',
                'Entretien proposé au terme d’un mandat syndical' => 'syndical',
            ),
            'label' => 'Contexte de la campagne'
            ));
        
        $builder->add('entdtDateent', DateType::class, array(
            'widget' => 'choice',
            'label' => 'Date de début de la campagne'
        ));

        $builder->add('entdtDatefinent', DateType::class, array(
            'widget' => 'choice',
            'label' => 'Date de fin de la campagne'
        ));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AccueilBundle\Entity\PepEntretien',
        ));
    }

}
