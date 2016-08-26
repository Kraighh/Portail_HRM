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
class PerspectiveType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('perlbCompetence', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'Efficacité' => '1',
                'Sens du service client(interne ou externe)' => '2',
                'Informatiques et techniques' => '3',
                'Relations transverses' => '4',
                'Communication orale' => '5',
                'Communication écrite' => '6',
                'Compétence métier' => '7',
                'Capacité d\'analyse et de synthèse' => '8',
                'Manageriales' => '9',
            )
        ));
        
        

        $builder->add('perlbCapacite', TextType::class);
        $builder->add('perlbMoyen', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'Formation' => '1',
                'Techniques de travail' => '2',
                'Démarche personnelle' => '3',
                'Autres' => '4',
            )
        ));
        $builder->add('perlbCommentaire', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AccueilBundle\Entity\PepPerspective',
        ));
    }

}
