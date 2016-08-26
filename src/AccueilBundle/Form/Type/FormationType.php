<?php

namespace AccueilBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of FormationType.
 *
 * @author RDUVAL002
 */
class FormationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('forlbStage');
        $builder->add('forlbIntitule');
        $builder->add('forlbDomaine');
        $builder->add('forlbTheme');
        $builder->add('forlbStatut');
        $builder->add('forlbSession');
        $builder->add('fordtDateDebut');
        $builder->add('fordtDateFin');
        $builder->add('forlbNbJours');
        $builder->add('forlbNbHeures');   
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AccueilBundle\Entity\Formation',
        ));
    }

}
