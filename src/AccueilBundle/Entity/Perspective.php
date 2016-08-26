<?php

namespace AccueilBundle\Entity;


class Perspective {

    private $peridId;
    private $perlbCompetence;
    private $perlbDescription;
    private $perlbCapacite;
    private $perlbMoyen;
    private $perlbCommentaire;
    private $salid;

    function __construct() {
        
    }

    public function setPeridId($peridId) {
        $this->peridId = $peridId;

        return $this;
    }

    public function getPeridId() {
        return $this->peridId;
    }

    public function setPerlbCompetence($perlbCompetence) {
        $this->perlbCompetence = $perlbCompetence;

        return $this;
    }

    public function getPerlbCompetence() {
        return $this->perlbCompetence;
    }

    public function setPerlbDescription($perlbDescription) {
        $this->perlbDescription = $perlbDescription;

        return $this;
    }

    public function getPerlbDescription() {
        return $this->perlbDescription;
    }

    public function setPerlbCapacite($perlbCapacite) {
        $this->perlbCapacite = $perlbCapacite;

        return $this;
    }

    public function getPerlbCapacite() {
        return $this->perlbCapacite;
    }

    public function setPerlbMoyen($perlbMoyen) {
        $this->perlbMoyen = $perlbMoyen;

        return $this;
    }

    public function getPerlbMoyen() {
        return $this->perlbMoyen;
    }

    public function setPerlbCommentaire($perlbCommentaire) {
        $this->perlbCommentaire = $perlbCommentaire;

        return $this;
    }

    public function getPerlbCommentaire() {
        return $this->perlbCommentaire;
    }

    public function setSalid(PepSalarie $salid) {
        $this->salid = $salid;

        return $this;
    }

    public function getSalid() {
        return $this->salid;
    }

}
