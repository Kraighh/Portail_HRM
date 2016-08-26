<?php

namespace AccueilBundle\Entity;

class Intervenant {
    
    private $intusNomPrenom;        
    private $intlbMetier;

    function getIntusNomPrenom() {
        return $this->intusNomPrenom;
    }

    function getIntlbMetier() {
        return $this->intlbMetier;
    }

    function setIntusNomPrenom($intusNomPrenom) {
        $this->intusNomPrenom = $intusNomPrenom;
    }

    function setIntlbMetier($intlbMetier) {
        $this->intlbMetier = $intlbMetier;
    }



}
