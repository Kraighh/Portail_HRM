<?php

namespace AccueilBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntretienType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('salarie', SalarieEntretienType::class);
        $builder->add('intervenant', ManagerType::class);
        
        $builder->add('entdtDateent', DateType::class, array(
            'widget' => 'single_text',
        ));
        $builder->add('entlbAvismanger', TextareaType::class);
        $builder->add('entlbAviscollaborateur', TextareaType::class);
        $builder->add('competence', TextareaType::class);
        $builder->add('faitmarquant', TextareaType::class);
        $builder->add('interetmotivation', TextareaType::class);
        $builder->add('projetPro', TextareaType::class);
        $builder->add('atoutfrein', TextareaType::class);
        $builder->add('besoinpro', TextareaType::class);
        $builder->add('submit', SubmitType::class, array('label' => 'Valider'));
        
        $builder->add('formation', CollectionType::class, array(
            'entry_type' => FormationType::class,
        ));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AccueilBundle\Entity\Entretien',
        ));
    }

}
