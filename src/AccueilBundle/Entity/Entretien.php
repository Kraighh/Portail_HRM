<?php

namespace AccueilBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

class Entretien {

    private $entidId;
    private $entdtDateDebut;
    private $entdtDateFin;
    private $entlbContexte;
    private $entlbEntreprise;
    private $entnbAnnee;
    private $entlbValidcollaborateur;
    private $entlbValidmanager;
    private $entlbValidrh;
    private $entlbAvismanger;
    private $entlbAviscollaborateur;
    private $entdtDateent;
    private $entlbType;
    private $idContrat;
    private $salid;
    private $intid;
    private $salarie;
    private $intervenant;
    private $formation;
    private $competence;
    private $faitmarquant;
    private $interetmotivation;
    private $nomPrenomCollab;
    private $projetPro;
    private $atoutfrein;
    private $besoinpro;

    function __construct() {
        $this->entdtDateent = new DateTime();
        $this->entdtDateDebut = new DateTime();
        $this->entdtDateFin = new DateTime();
        $this->salarie = new Salarie();
        $this->intervenant = new Intervenant();
        $this->formation = new ArrayCollection();
    }

    function getProjetPro() {
        return $this->projetPro;
    }

    function getAtoutfrein() {
        return $this->atoutfrein;
    }

    function getBesoinpro() {
        return $this->besoinpro;
    }

    function setProjetPro($projetPro) {
        $this->projetPro = $projetPro;
    }

    function setAtoutfrein($atoutfrein) {
        $this->atoutfrein = $atoutfrein;
    }

    function setBesoinpro($besoinpro) {
        $this->besoinpro = $besoinpro;
    }

    function getNomPrenomCollab() {
        return $this->nomPrenomCollab;
    }

    function setNomPrenomCollab($nomPrenomCollab) {
        $this->nomPrenomCollab = $nomPrenomCollab;
    }

    function getCompetence() {
        return $this->competence;
    }

    function getFaitmarquant() {
        return $this->faitmarquant;
    }

    function getInteretmotivation() {
        return $this->interetmotivation;
    }

    function setCompetence($competence) {
        $this->competence = $competence;
    }

    function setFaitmarquant($faitmarquant) {
        $this->faitmarquant = $faitmarquant;
    }

    function setInteretmotivation($interetmotivation) {
        $this->interetmotivation = $interetmotivation;
    }

    function getFormation() {
        return $this->formation;
    }

    function setFormation($formation) {
        $this->formation = $formation;
    }

    function getSalarie() {
        return $this->salarie;
    }

    function getIntervenant() {
        return $this->intervenant;
    }

    function setSalarie($salarie) {
        $this->salarie = $salarie;
    }

    function setIntervenant($intervenant) {
        $this->intervenant = $intervenant;
    }

    function getIdContrat() {
        return $this->idContrat;
    }

    function setIdContrat($idContrat) {
        $this->idContrat = $idContrat;
    }

    function getEntlbType() {
        return $this->entlbType;
    }

    function setEntlbType($entlbType) {
        $this->entlbType = $entlbType;
    }

    function getEntidId() {
        return $this->entidId;
    }

    function getEntlbContexte() {
        return $this->entlbContexte;
    }

    function getEntlbEntreprise() {
        return $this->entlbEntreprise;
    }

    function getEntnbAnnee() {
        return $this->entnbAnnee;
    }

    function getEntlbValidcollaborateur() {
        return $this->entlbValidcollaborateur;
    }

    function getEntlbValidmanager() {
        return $this->entlbValidmanager;
    }

    function getEntlbValidrh() {
        return $this->entlbValidrh;
    }

    function getEntlbAvismanger() {
        return $this->entlbAvismanger;
    }

    function getEntlbAviscollaborateur() {
        return $this->entlbAviscollaborateur;
    }

    function getEntdtDateent() {
        return $this->entdtDateent;
    }

    function getSalid() {
        return $this->salid;
    }

    function getIntid() {
        return $this->intid;
    }

    function setEntidId($entidId) {
        $this->entidId = $entidId;
    }

    function setEntlbContexte($entlbContexte) {
        $this->entlbContexte = $entlbContexte;
    }

    function setEntlbEntreprise($entlbEntreprise) {
        $this->entlbEntreprise = $entlbEntreprise;
    }

    function setEntnbAnnee($entnbAnnee) {
        $this->entnbAnnee = $entnbAnnee;
    }

    function setEntlbValidcollaborateur($entlbValidcollaborateur) {
        $this->entlbValidcollaborateur = $entlbValidcollaborateur;
    }

    function setEntlbValidmanager($entlbValidmanager) {
        $this->entlbValidmanager = $entlbValidmanager;
    }

    function setEntlbValidrh($entlbValidrh) {
        $this->entlbValidrh = $entlbValidrh;
    }

    function setEntlbAvismanger($entlbAvismanger) {
        $this->entlbAvismanger = $entlbAvismanger;
    }

    function setEntlbAviscollaborateur($entlbAviscollaborateur) {
        $this->entlbAviscollaborateur = $entlbAviscollaborateur;
    }

    function setEntdtDateent($entdtDateent) {
        $this->entdtDateent = $entdtDateent;
    }

    function setSalid($salid) {
        $this->salid = $salid;
    }

    function setIntid($intid) {
        $this->intid = $intid;
    }

    function getEntdtDateDebut() {
        return $this->entdtDateDebut;
    }

    function getEntdtDateFin() {
        return $this->entdtDateFin;
    }

    function setEntdtDateDebut($entdtDateDebut) {
        $this->entdtDateDebut = $entdtDateDebut;
    }

    function setEntdtDateFin($entdtDateFin) {
        $this->entdtDateFin = $entdtDateFin;
    }

}
