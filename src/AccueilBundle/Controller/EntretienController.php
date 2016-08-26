<?php

namespace AccueilBundle\Controller;

use AccueilBundle\Entity\Entretien;
use AccueilBundle\Entity\Formation;
use AccueilBundle\Entity\Intervenant;
use AccueilBundle\Entity\Salarie;
use AccueilBundle\Form\Type\EntretienType;
use AccueilBundle\Form\Type\RechercheType;
use AccueilBundle\Soap\soap;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EntretienController extends Controller {

    //index pour manager
    //chargement des entretiens perso
    //chargement des entretiens de ses collaborateurs
    public function indexAction(Request $request) {

        if ($this->get('session')->get('codeUser') == true) {
            $soap = new soap();
            $recherche = new Entretien();
            $lstEntretiensSubs = array();
            $lstNomPrenom = array();
            $lstNomPrenom[0] = 'Tous';

            $subs = $soap->getMatriSub($this->get('session')->get('matricule'));
            $i = 0;
            foreach ($subs->TAB->LIN as $sub) {
                $entretiensSubs = $soap->getInfosEntretien($sub->FLD);

                if (isset($entretiensSubs->TAB->LIN)) {
                    foreach ($entretiensSubs->TAB->LIN as $e) {
                        $verif = 0;
                        $codeUsr = $soap->getCodeUsrMat($e->FLD[0])->GRP->FLD[1];
                        $entretien = new Entretien();
                        $entretien->setSalid($e->FLD[0]);
                        $entretien->setNomPrenomCollab($soap->getNomPrenom($codeUsr)->GRP->FLD[1]);
                        $entretien->setIdContrat($e->FLD[1]);
                        $entretien->setEntdtDateDebut($e->FLD[2]);
                        $entretien->setEntdtDateFin($e->FLD[3]);
                        $entretien->setEntlbType($e->FLD[4]);
                        $lstEntretiensSubs[$i] = $entretien;

                        if (!in_array($this->xml2array($entretien->getNomPrenomCollab())[0], $lstNomPrenom)) {
                            $lstNomPrenom[$i + 1] = $entretien->getNomPrenomCollab();
                        }

                        $i++;
                    }
                }
            }

            $formRecherche = $this->createForm(RechercheType::class, $recherche, array(
                'personnes' => $lstNomPrenom,
            ));

            $rechercheCollaborateurs = new Entretien();
            $formRechercheCollaborateurs = $this->createForm(RechercheType::class, $rechercheCollaborateurs);
            $formRechercheCollaborateurs->handleRequest($request);
            if ($formRechercheCollaborateurs->isSubmitted() && $formRechercheCollaborateurs->isValid()) {
                
            }

            //get request
            $formRecherche->handleRequest($request);

            //if the form is submited
            if ($formRecherche->isSubmitted() && $formRecherche->isValid()) {
                
            }

            //get entretien from HRM

            $entretiens = $soap->getInfosEntretien($this->get('session')->get('matricule'));
            $lstEntretien = array();
            $i = 0;

            foreach ($entretiens->TAB->LIN as $e) {
                $entretien = new Entretien();
                $entretien->setSalid($e->FLD[0]);
                $entretien->setIdContrat($e->FLD[1]);
                $entretien->setEntdtDateDebut($e->FLD[2]);
                $entretien->setEntdtDateFin($e->FLD[3]);
                $entretien->setEntlbType($e->FLD[4]);
                $lstEntretien[$i] = $entretien;
                $i++;
            }

            return $this->render('AccueilBundle:Default:accueil_entretien.html.twig', array(
                        'formRecherche' => $formRecherche->createView(),
                        'lstEntretien' => $lstEntretien,
                        'entretien' => $entretien,
                        'lstEntretiensSubs' => $lstEntretiensSubs
            ));
        } else {
            $error = "Aucune entete HTTP n'a été trouvé, veillez vous authentifier à partir du portail !";
            return $this->render('AccueilBundle:Default:error.html.twig', array(
                        'error' => $error
            ));
        }
    }

    //index pour les non manager
    //affichage des entretiens perso uniquement
    //pas d'accès modif
    public function indexcollabAction() {
        if ($this->get('session')->get('codeUser') == true) {
            $soap = new soap();
            $lstEntretiensSubs = array();
            $recherche = new Entretien();
            $formRecherche = $this->createForm(RechercheType::class, $recherche);

            //get entretien from HRM

            $entretiens = $soap->getInfosEntretien($this->get('session')->get('matricule'));
            $lstEntretien = array();
            $i = 0;

            foreach ($entretiens->TAB->LIN as $e) {
                $entretien = new Entretien();
                $entretien->setSalid($e->FLD[0]);
                $entretien->setIdContrat($e->FLD[1]);
                $entretien->setEntdtDateDebut($e->FLD[2]);
                $entretien->setEntdtDateFin($e->FLD[3]);
                $entretien->setEntlbType($e->FLD[4]);
                $lstEntretien[$i] = $entretien;
                $i++;
            }

            return $this->render('AccueilBundle:Default:accueil_entretien.html.twig', array(
                        'formRecherche' => $formRecherche->createView(),
                        'lstEntretien' => $lstEntretien,
                        'entretien' => $entretien,
                        'lstEntretiensSubs' => $lstEntretiensSubs
            ));
        } else {
            $error = "Aucune entete HTTP n'a été trouvé, veillez vous authentifier à partir du portail !";
            return $this->render('AccueilBundle:Default:error.html.twig', array(
                        'error' => $error
            ));
        }
    }

    //récupération du détail d'un entretien + passage à la vue
    public function entretienAction(Request $request, $id, $contrat, $dateDebut, $dateFin, $type) {

        $soap = new soap();
        $entretien = new Entretien();
        $salarie = new Salarie();
        $intervenant = new Intervenant();

        $entretienSoap = $soap->getEva($id, $contrat, $dateDebut, $dateFin, $type);

        if (isset($entretienSoap->TAB->LIN)) {
            foreach ($entretienSoap->TAB->LIN as $e) {
                $formation = new Formation();
                $formation->setFordtDateDebut($e->FLD[8]);
                $formation->setFordtDateFin($e->FLD[9]);
                $formation->setForlbIntitule($e->FLD[1]);
                $formation->setForlbNbHeures($e->FLD[11]);
                $formation->setForlbNbJours($e->FLD[10]);
                $formation->setForlbSession($e->FLD[7]);
                $formation->setForlbStage($e->FLD[0]);
                $formation->setForlbStatut($e->FLD[6]);
                $entretien->getFormation()->add($formation);
            }
        }
        //infos entretien
        $entretien->setEntdtDateDebut($this->SageToDate($dateDebut));
        $entretien->setEntdtDateFin($this->SageToDate($dateFin));
        $entretien->setEntlbType($type);
        $entretien->setIdContrat($contrat);

        $entretien->setAtoutfrein($entretienSoap->GRP[14]->FLD[1]);
        $entretien->setBesoinpro($entretienSoap->GRP[14]->FLD[0]);
        $entretien->setProjetPro($entretienSoap->GRP[5]->FLD);
        $entretien->setCompetence($entretienSoap->GRP[13]->FLD[0]);
        $entretien->setEntlbAviscollaborateur($entretienSoap->GRP[12]->FLD);
        $entretien->setEntlbAvismanger($entretienSoap->GRP[11]->FLD);
        $entretien->setFaitmarquant($entretienSoap->GRP[13]->FLD[1]);
        $entretien->setInteretmotivation($entretienSoap->GRP[13]->FLD[2]);


        //infos contrat
        $dateContrat = $soap->getDateContrat($contrat, $id)->GRP->FLD[2];
        $contratSoap = $soap->getContrat($contrat, $id, $dateContrat);

        //infos user
        $codeUsr = $soap->getCodeUsrMat($id)->GRP->FLD[1];
        $salarieSoap = $soap->getUsr($codeUsr);

        $salarie->setSalusNomPrenom($salarieSoap->GRP[0]->FLD[1]);
        $salarie->setSaldtDebut($this->SageToDate($contratSoap->GRP[5]->FLD[0]));
        $salarie->setSallbMetier($contratSoap->GRP[3]->FLD[9]);
        $salarie->setSallbNiveau($contratSoap->GRP[8]->FLD[7]);
        $salarie->setSallbCoef($contratSoap->GRP[8]->FLD[5]);

        $intervenant->setIntusNomPrenom($contratSoap->TAB->LIN->FLD[2]);

        $entretien->setSalarie($salarie);
        $entretien->setIntervenant($intervenant);

        $form = $this->createForm(EntretienType::class, $entretien);

        //get request
        $form->handleRequest($request);

        //if the form is submited
        if ($form->isSubmitted() && $form->isValid()) {
            $competence = $entretien->getCompetence();
            $faitmarquant = $entretien->getFaitmarquant();
            $interetmotivation = $entretien->getInteretmotivation();
            $avisM = $entretien->getEntlbAvismanger();
            $avisC = $entretien->getEntlbAviscollaborateur();
            $projetpro = $entretien->getProjetPro();
            $besoinpro = $entretien->getBesoinpro();
            $freins = $entretien->getAtoutfrein();

            $res = $soap->modify($id, $contrat, $dateDebut, $dateFin, $type, $competence, $faitmarquant, $interetmotivation, $avisM, $avisC, $besoinpro, $freins, $projetpro);

            //return $this->redirectToRoute('accueil_entretien');
        }

        //redirect to another page
        return $this->render('AccueilBundle:Entretien:entretien.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    //zone de recherche AJAX
    public function resultatrechercheAction(Request $request) {

        if ($request->isXmlHttpRequest()) {
            $annee = '';
            $lstEntretiensSubs = array();
            $annee = $request->request->get('annee');
            $nomPrenom = $request->request->get('nomPrenom');

            $soap = new soap();

            $subs = $soap->getMatriSub($this->get('session')->get('matricule'));
            $i = 0;
            if (isset($subs->TAB->LIN)) {
                foreach ($subs->TAB->LIN as $sub) {
                    $entretiensSubs = $soap->getInfosEntretien($sub->FLD);

                    if (isset($entretiensSubs->TAB->LIN)) {
                        foreach ($entretiensSubs->TAB->LIN as $e) {
                            $codeUsr = $soap->getCodeUsrMat($e->FLD[0])->GRP->FLD[1];
                            $entretien = new Entretien();
                            $entretien->setSalid($e->FLD[0]);
                            $entretien->setNomPrenomCollab($soap->getNomPrenom($codeUsr)->GRP->FLD[1]);
                            $entretien->setIdContrat($e->FLD[1]);
                            $entretien->setEntdtDateDebut($e->FLD[2]);
                            $entretien->setEntdtDateFin($e->FLD[3]);
                            $entretien->setEntlbType($e->FLD[4]);
                            $entretienSoap = $soap->getEva($entretien->getSalid(), $entretien->getIdContrat(), $entretien->getEntdtDateDebut(), $entretien->getEntdtDateFin(), $entretien->getEntlbType());

                            if ($annee == 'Tous' && $nomPrenom != 'Tous') {
                                if ($nomPrenom == $entretienSoap->GRP[0]->FLD[5]) {
                                    $lstEntretiensSubs[$i] = $entretien;
                                }
                            } elseif ($annee != 'Tous' && $nomPrenom == 'Tous') {
                                if ($annee == substr($entretienSoap->GRP->FLD[3], 0, 4)) {
                                    $lstEntretiensSubs[$i] = $entretien;
                                }
                            } elseif ($annee != 'Tous' && $nomPrenom != 'Tous') {
                                if (($annee == substr($entretienSoap->GRP->FLD[3], 0, 4)) && ($nomPrenom == $entretienSoap->GRP[0]->FLD[5])) {
                                    $lstEntretiensSubs[$i] = $entretien;
                                }
                            } else {
                                $lstEntretiensSubs[$i] = $entretien;
                            }
                            $i++;
                        }
                    }
                }
            }
            return $this->container->get('templating')->renderResponse('AccueilBundle:Entretien:collaborateurs.html.twig', array(
                        'lstEntretiensSubs' => $lstEntretiensSubs
            ));
        } else {
            echo "tamere";
        }
    }

    //génération + téléchargement fichier pdf
    public function pdfAction() {

        $html = $this->renderView('AccueilBundle:Entretien:entretienpdf.html.twig', array(
            'rootDir' => $this->get('kernel')->getRootDir() . '/..'
        ));
        if (isset($_SESSION['codeUser'])) {
            return new Response(
                    $this->get('knp_snappy.pdf')->getOutputFromHtml($html), 200, array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="file.pdf"'
                    )
            );
        } else {
            $error = "Aucune entete HTTP n'a été trouvé, veillez vous authentifier à partir du portail !";
            return $this->render('AccueilBundle:Default:error.html.twig', array(
                        'error' => $error
            ));
        }
    }

    //passage de la date hrm en datetime
    public function SageToDate($date) {
        $annee = substr($date, 0, 4);
        $mois = substr($date, 4, 2);
        $jour = substr($date, 6, 2);
        $datetime = new DateTime();
        return($datetime->createFromFormat('d-m-Y', $jour . '-' . $mois . '-' . $annee));
    }

    //passage de xmlObject à array()
    function xml2array($xmlObject, $out = array()) {
        foreach ((array) $xmlObject as $index => $node)
            $out[$index] = ( is_object($node) ) ? xml2array($node) : $node;

        return $out;
    }

}
