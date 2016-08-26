<?php

namespace AccueilBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratEntretienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('metier', ChoiceType::class, array(
            'choices' => array(
                '--Selectionnez une valeur--' => '',
                'Technicien de déploiement' => 'Technicien de déploiement',
                'Developpeur informatique' => 'Developpeur informatique',
            ),
        ));

        $builder->add('dateEntreeEntreprise', DateType::class, array(
            'widget' => 'choice',
        ));

        $builder->add('niveau');
        $builder->add('coefficient');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AccueilBundle\Entity\Contrat',
        ));
    }
}
