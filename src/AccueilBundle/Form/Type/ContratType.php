<?php

namespace AccueilBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nature', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'CDD' => 'CDD',
                'CDI' => 'CDI',
                'Stage' => 'Stage',
            ),
        ));
        $builder->add('libellePoste', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'Technicien de déploiement' => 'Technicien de déploiement',
                'Developpeur informatique' => 'Developpeur informatique',
            ),
        ));
        $builder->add('motifCDD', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'Surcroît activité' => 'Surcroît activité',
                'Remplacement' => 'Remplacement',
            ),
        ));
        $builder->add('justificatifCDD');
        $builder->add('remplacement', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'DE CONDE Xavier' => 'DE CONDE Xavier',
                'LECOMTE Sophie' => 'LECOMTE Sophie',
            ),
        ));
        $builder->add('dateDebut', DateType::class, array(
            'widget' => 'choice',
        ));
        $builder->add('motifDebutHRM');
        $builder->add('dateFinCDD', DateType::class, array(
            'widget' => 'choice',
        ));
        $builder->add('site', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'QMP' => 'QMP',
                'RNS' => 'RNS',
                'LYN' => 'LYN',
            ),
        ));
        $builder->add('horaireHebdo');
        $builder->add('horaireMensuel');
        $builder->add('tauxTemps');
        $builder->add('repartitionHeures');
        $builder->add('codeAffaire');
        $builder->add('codeAnalytique');
        $builder->add('manager', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'CORTET Pascal' => 'CORTET Pascal',
                'ROUILLIER Jean-Christophe' => 'ROUILLIER Jean-Christophe',
            ),
        ));
        $builder->add('service', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'DSI Etudes Rennes' => 'DSI Etudes Rennes',
                'DSI Etudes Lyon' => 'DSI Etudes Lyon',
            ),
        ));
        $builder->add('convention', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'Mettalurigie du Rhône' => 'Mettalurigie du Rhône',
                'Mettalurgie Yonne' => 'Mettalurgie Yonne',
            ),
        ));
        $builder->add('profil', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'Etam' => 'Etam',
                'Cadre' => 'Cadre',
            ),
        ));
        $builder->add('classification');
        $builder->add('indice');
        $builder->add('codeEmploi');
        $builder->add('salaireMensuel');
        $builder->add('primeVariable');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AccueilBundle\Entity\Contrat',
        ));
    }
}
