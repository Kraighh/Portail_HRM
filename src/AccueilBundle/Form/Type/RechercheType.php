<?php

namespace AccueilBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {


        $personnes = $options['personnes'];


        $builder->add('entnbAnnee', ChoiceType::class, array(
            'choices' => array(
                "Tous" => "Tous",
                "2015" => "2015",
                "2016" => "2016",
                "2017" => "2017",
                "2018" => "2018",
                "2019" => "2019",
                "2020" => "2020",
                "2021" => "2021",
                "2022" => "2022",
            )
        ));

        $builder->add('nomPrenomCollab', ChoiceType::class, [
            'choices' => $personnes,
            'choice_label' => function($personnes) {                
                return ($personnes);
            },
                ]
        );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AccueilBundle\Entity\Entretien',
            'personnes' => null,
        ));
    }

}

//range(date('Y')-5, date('Y')+5)
