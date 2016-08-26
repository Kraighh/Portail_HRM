<?php

namespace AccueilBundle\Entity;

use Symfony\Component\Validator\Constraints\DateTime;

class Salarie {

    private $salidId;
    private $salusNomPrenom;
    private $saldtDebut;
    private $sallbMetier;
    private $sallbNiveau;
    private $sallbCoef;
    private $sallbCompetence;
    private $sallbFaitmarquant;
    private $sallbInteret;
    private $sallbProjet;
    private $sallbAtout;
    private $sallbBesoin;
    private $perspective;

    function __construct() {

        //$this->perspective = new ArrayCollection();
        $this->saldtDebut = new DateTime();
    }

    function getSalidId() {
        return $this->salidId;
    }

    function getSalusNomPrenom() {
        return $this->salusNomPrenom;
    }

    function getSaldtDebut() {
        return $this->saldtDebut;
    }

    function getSallbMetier() {
        return $this->sallbMetier;
    }

    function getSallbNiveau() {
        return $this->sallbNiveau;
    }

    function getSallbCoef() {
        return $this->sallbCoef;
    }

    function getSallbCompetence() {
        return $this->sallbCompetence;
    }

    function getSallbFaitmarquant() {
        return $this->sallbFaitmarquant;
    }

    function getSallbInteret() {
        return $this->sallbInteret;
    }

    function getSallbProjet() {
        return $this->sallbProjet;
    }

    function getSallbAtout() {
        return $this->sallbAtout;
    }

    function getSallbBesoin() {
        return $this->sallbBesoin;
    }

    function getPerspective() {
        return $this->perspective;
    }

    function setSalidId($salidId) {
        $this->salidId = $salidId;
    }

    function setSalusNomPrenom($salusNomPrenom) {
        $this->salusNomPrenom = $salusNomPrenom;
    }

    function setSaldtDebut($saldtDebut) {
        $this->saldtDebut = $saldtDebut;
    }

    function setSallbMetier($sallbMetier) {
        $this->sallbMetier = $sallbMetier;
    }

    function setSallbNiveau($sallbNiveau) {
        $this->sallbNiveau = $sallbNiveau;
    }

    function setSallbCoef($sallbCoef) {
        $this->sallbCoef = $sallbCoef;
    }

    function setSallbCompetence($sallbCompetence) {
        $this->sallbCompetence = $sallbCompetence;
    }

    function setSallbFaitmarquant($sallbFaitmarquant) {
        $this->sallbFaitmarquant = $sallbFaitmarquant;
    }

    function setSallbInteret($sallbInteret) {
        $this->sallbInteret = $sallbInteret;
    }

    function setSallbProjet($sallbProjet) {
        $this->sallbProjet = $sallbProjet;
    }

    function setSallbAtout($sallbAtout) {
        $this->sallbAtout = $sallbAtout;
    }

    function setSallbBesoin($sallbBesoin) {
        $this->sallbBesoin = $sallbBesoin;
    }

    function setPerspective($perspective) {
        $this->perspective = $perspective;
    }

}
