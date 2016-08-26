<?php

namespace AccueilBundle\Entity;

use Symfony\Component\Validator\Constraints\DateTime;

class Formation {

    private $forlbStage;
    private $forlbIntitule;
    private $forlbDomaine;
    private $forlbTheme;
    private $forlbStatut;
    private $forlbSession;
    private $fordtDateDebut;
    private $fordtDateFin;
    private $forlbNbJours;
    private $forlbNbHeures;    
    

    function __construct() {

    }

    function getForlbStage() {
        return $this->forlbStage;
    }

    function getForlbIntitule() {
        return $this->forlbIntitule;
    }

    function getForlbDomaine() {
        return $this->forlbDomaine;
    }

    function getForlbTheme() {
        return $this->forlbTheme;
    }

    function getForlbStatut() {
        return $this->forlbStatut;
    }

    function getForlbSession() {
        return $this->forlbSession;
    }

    function getFordtDateDebut() {
        return $this->fordtDateDebut;
    }

    function getFordtDateFin() {
        return $this->fordtDateFin;
    }

    function getForlbNbJours() {
        return $this->forlbNbJours;
    }

    function getForlbNbHeures() {
        return $this->forlbNbHeures;
    }

    function setForlbStage($forlbStage) {
        $this->forlbStage = $forlbStage;
    }

    function setForlbIntitule($forlbIntitule) {
        $this->forlbIntitule = $forlbIntitule;
    }

    function setForlbDomaine($forlbDomaine) {
        $this->forlbDomaine = $forlbDomaine;
    }

    function setForlbTheme($forlbTheme) {
        $this->forlbTheme = $forlbTheme;
    }

    function setForlbStatut($forlbStatut) {
        $this->forlbStatut = $forlbStatut;
    }

    function setForlbSession($forlbSession) {
        $this->forlbSession = $forlbSession;
    }

    function setFordtDateDebut($fordtDateDebut) {
        $this->fordtDateDebut = $fordtDateDebut;
    }

    function setFordtDateFin($fordtDateFin) {
        $this->fordtDateFin = $fordtDateFin;
    }

    function setForlbNbJours($forlbNbJours) {
        $this->forlbNbJours = $forlbNbJours;
    }

    function setForlbNbHeures($forlbNbHeures) {
        $this->forlbNbHeures = $forlbNbHeures;
    }



}
