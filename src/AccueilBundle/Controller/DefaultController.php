<?php

namespace AccueilBundle\Controller;

use AccueilBundle\Soap\soap;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        $this->get('session')->clear();
        $session = $request->getSession();
        $_SERVER['HTTP_AUTH_USER'] = "RDUVAL002";
        if (isset($_SERVER['HTTP_AUTH_USER'])) {

            $login = strtoupper($_SERVER['HTTP_AUTH_USER']);
            $login="PCORTET";
            $soap = new soap();
            $infoUsr = $soap->getCodeUsr($login);
            $codeUsr = $infoUsr->GRP->FLD[1];
            $manager = $infoUsr->GRP->FLD[2];
            $matricule = $infoUsr->GRP->FLD[3];

            $user = $soap->getUsr($codeUsr);            
         
            if ($user->TYPE == 3) {
                return $this->render('AccueilBundle:Default:error.html.twig', array(
                            'error' => $user->MESSAGE
                ));
            } else {
                $session->set('codeUser', strval($codeUsr));
                $session->set('loginUser', $login);
                $session->set('manager', strval($manager));
                $session->set('matricule', strval($matricule));
                
                /* Création objet salarié */
                $nomPrenom = explode(" ", $user->GRP[0]->FLD[1]);

                return $this->render('AccueilBundle:Default:index.html.twig', array(
                            'nomUser' => $nomPrenom[0],
                            'prenomUser' => $nomPrenom[1],
                ));
            }
        } else {
            $error = "Aucune entete HTTP n'a été trouvé, veillez vous authentifier à partir du portail !";
            return $this->render('AccueilBundle:Default:error.html.twig', array(
                        'error' => $error
            ));
        }
    }

    public function constructionAction() {
        if (isset($_SESSION['codeUser'])) {
            return $this->render('AccueilBundle:Default:construction.html.twig');
        } else {
            $error = "Aucune entete HTTP n'a été trouvé, veillez vous authentifier à partir du portail !";
            return $this->render('AccueilBundle:Default:error.html.twig', array(
                        'error' => $error
            ));
        }
    }

}
