<?php

namespace AccueilBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalarieEntretienType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('salusNomPrenom', TextType::class, array(
            'attr' => array('disabled' => 'disabled')
        ));

        $builder->add('saldtDebut', DateType::class, array(
            'widget' => 'single_text',
            'years' => range(1984, 2050),
            'attr' => array('disabled' => 'disabled')
        ));

        $builder->add('sallbMetier', TextType::class, array(
            'attr' => array('disabled' => 'disabled')
        ));
        $builder->add('sallbNiveau', TextType::class, array(
            'attr' => array('disabled' => 'disabled')
        ));
        $builder->add('sallbCoef', TextType::class, array(
            'attr' => array('disabled' => 'disabled')
        ));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AccueilBundle\Entity\Salarie',
        ));
    }

}
