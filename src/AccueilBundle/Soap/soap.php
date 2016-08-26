<?php

namespace AccueilBundle\Soap;

use SimpleXMLElement;
use SoapClient;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class soap {
    /*     * ****************************************************************************************
      Infos utilisateurs
     * **************************************************************************************** */

    //Récupère l'objet utilisateur en fonction du code utilisateur
    function getUsr($codeUsr) {
        include "include.php";

        $Cle["key"] = "USR";
        $Cle["value"] = $codeUsr;
        $Cles[0] = $Cle;

        $client = new SoapClient($uri);
        try {
            $result = $client->read($CallContext, "ZAUS", $Cles);
            $xml = simplexml_load_string($result->resultXml);
            $status = (int) $result->status;
            // if status = 1 then request was successful
            if ($status == 1) {
                return new SimpleXMLElement($result->resultXml);
            } else {
                $messages = $result->messages;
                $nbmess = sizeof($messages);
                $lig = "";
                for ($i = 0; $i < $nbmess; $i++) {
                    $lig.="<ERROR><TYPE>" . $messages[$i]->type . "</TYPE><MESSAGE>" . $messages[$i]->message . "</MESSAGE></ERROR>";
                }
                $res = $lig;

                $xml = simplexml_load_string($res);
                return new SimpleXMLElement($xml->asXML());
            }
        } catch (Exception $e) {
            return false;
        }
    }

    //récupère le code+matricule+manager salarié en fonction du login
    function getCodeUsr($login) {
        include "include.php";

        $xml = <<<XML
        <PARAM>
            <GRP ID="GRP1" >
		<FLD NAME="ZLOGIN" >$login</FLD>
            </GRP>
        </PARAM>
XML;

        $client = new soapclient($uri);
        $result = $client->run($CallContext, "ZRECHUSER", $xml);
        $xml = simplexml_load_string($result->resultXml);

        return new SimpleXMLElement($result->resultXml);
    }

    //Récupère le code utilisateur en fonction du matricule
    function getCodeUsrMat($matricule) {
        include "include.php";

        $xml = <<<XML
<PARAM>
	<GRP ID="GRP1" >
		<FLD NAME="ZMATRI" >$matricule</FLD>
	</GRP>
</PARAM>

XML;

        $client = new soapclient($uri);
        $result = $client->run($CallContext, "ZRECHAUS", $xml);
        $xml = simplexml_load_string($result->resultXml);

        return new SimpleXMLElement($result->resultXml);
    }

    //Renvoi le nom prenom en fonction du code utilisateur
    function getNomPrenom($codeUsr) {
        include "include.php";

        $xml = <<<XML
<PARAM>
	<GRP ID="GRP1" >
		<FLD NAME="ZCODEUSR" >$codeUsr</FLD>
	</GRP>
</PARAM>


XML;

        $client = new soapclient($uri);
        $result = $client->run($CallContext, "ZRECHNOM", $xml);
        $xml = simplexml_load_string($result->resultXml);

        return new SimpleXMLElement($result->resultXml);
    }

    /*     * ****************************************************************************************
      Partie Manager
     * **************************************************************************************** */

    function getMatriSub($matricule) {
        include "include.php";

        $xml = <<<XML
<PARAM>
	<GRP ID="GRP1" >
		<FLD NAME="ZLOGIN" >$matricule</FLD>
	</GRP>
</PARAM>

XML;

        $client = new soapclient($uri);
        $result = $client->run($CallContext, "ZRECHSUB", $xml);
        $xml = simplexml_load_string($result->resultXml);

        return new SimpleXMLElement($result->resultXml);
    }

    /*     * ****************************************************************************************
      Maj HRM après validation RH
     * **************************************************************************************** */


    /*     * ****************************************************************************************
      récupération CDI-CDD
     * **************************************************************************************** */

    //récupère la liste des matricule des salariés en cdd ou cdi
    function getContratCourant() {
        include "include.php";

        $xml = <<<XML
<PARAM>
	
</PARAM>
XML;

        $client = new soapclient($uri);
        $result = $client->run($CallContext, "ZRECHCON", $xml);
        $xml = simplexml_load_string($result->resultXml);

        return new SimpleXMLElement($result->resultXml);
    }

    function getNbCddCdi() {
        include "include.php";

        $xml = <<<XML
<PARAM>
	
</PARAM>
XML;

        $client = new soapclient($uri);
        $result = $client->run($CallContext, "ZRECHCON", $xml);
        $xml = simplexml_load_string($result->resultXml);

        return new SimpleXMLElement($result->resultXml);
    }

    //récupère les informations des entretiens d'un collaborateur en fonction de son matricule
    function getInfosEntretien($matricule) {
        include "include.php";

        $xml = <<<XML
<PARAM>
	<GRP ID="GRP1" >
		<FLD NAME="ZREFNUM" >$matricule</FLD>
	</GRP>
</PARAM>

XML;

        $client = new soapclient($uri);
        $result = $client->run($CallContext, "ZRECHENT", $xml);
        $xml = simplexml_load_string($result->resultXml);

        return new SimpleXMLElement($result->resultXml);
    }

    //recupere l'objet entretien
    function getEva($id, $contrat, $dateDebut, $dateFin, $type) {
        include "include.php";

        //$Cle["key"] = "EVA";
        //$Cle["value"] = array($id, $contrat, $dateDebut, $dateFin, $type);
        $Cles = array(
            array("key" => "REFNUM", "value" => $id),
            array("key" => "CTRNUM", "value" => $contrat),
            array("key" => "EVADATSTR", "value" => $dateDebut),
            array("key" => "EVADATEND", "value" => $dateFin),
            array("key" => "EVATYP", "value" => $type)
        );

        $client = new SoapClient($uri);
        try {
            $result = $client->read($CallContext, "ZEVA", $Cles);
            $xml = simplexml_load_string($result->resultXml);
            $status = (int) $result->status;
            // if status = 1 then request was successful
            if ($status == 1) {
                return new SimpleXMLElement($result->resultXml);
            } else {
                $messages = $result->messages;
                $nbmess = sizeof($messages);
                $lig = "";
                for ($i = 0; $i < $nbmess; $i++) {
                    $lig.="<ERROR><TYPE>" . $messages[$i]->type . "</TYPE><MESSAGE>" . $messages[$i]->message . "</MESSAGE></ERROR>";
                }
                $res = $lig;

                $xml = simplexml_load_string($res);
                return new SimpleXMLElement($xml->asXML());
            }
        } catch (Exception $e) {
            return false;
        }
    }

    //retourne la date de contrat en fonction du code contrat et du matricule
    public function getDateContrat($codeContrat, $matricule) {
        include "include.php";

        $xml = <<<XML
        <PARAM>
	<GRP ID="GRP1" >
		<FLD NAME="ZCODE" >$codeContrat</FLD>
		<FLD NAME="ZMATRI" >$matricule</FLD>
	</GRP>
</PARAM>

XML;

        $client = new soapclient($uri);
        $result = $client->run($CallContext, "ZDTCTR", $xml);
        $xml = simplexml_load_string($result->resultXml);

        return new SimpleXMLElement($result->resultXml);
    }

    public function getContrat($codeContrat, $matricule, $dateContrat) {
        include "include.php";

        //$Cle["key"] = "EVA";
        //$Cle["value"] = array($id, $contrat, $dateDebut, $dateFin, $type);
        $Cles = array(
            array("key" => "REFNUM", "value" => $matricule),
            array("key" => "CTRNUM", "value" => $codeContrat),
            array("key" => "CTRDAT", "value" => $dateContrat)
        );

        $client = new SoapClient($uri);
        try {
            $result = $client->read($CallContext, "ZCTR", $Cles);
            $xml = simplexml_load_string($result->resultXml);
            $status = (int) $result->status;
            // if status = 1 then request was successful
            if ($status == 1) {
                return new SimpleXMLElement($result->resultXml);
            } else {
                $messages = $result->messages;
                $nbmess = sizeof($messages);
                $lig = "";
                for ($i = 0; $i < $nbmess; $i++) {
                    $lig.="<ERROR><TYPE>" . $messages[$i]->type . "</TYPE><MESSAGE>" . $messages[$i]->message . "</MESSAGE></ERROR>";
                }
                $res = $lig;

                $xml = simplexml_load_string($res);
                return new SimpleXMLElement($xml->asXML());
            }
        } catch (Exception $e) {
            return false;
        }
    }

    ##############################################################################

    public function modify($id, $contrat, $dateDebut, $dateFin, $type, $competence, $faitmarquant, $interet, $avism, $avisc, $besoinpro, $frein, $projetpro) {
        include "include.php";

        $Cles = array(
            array("key" => "REFNUM", "value" => $id),
            array("key" => "CTRNUM", "value" => $contrat),
            array("key" => "EVADATSTR", "value" => $dateDebut),
            array("key" => "EVADATEND", "value" => $dateFin),
            array("key" => "EVATYP", "value" => $type)
        );


        $xml = <<<XML
<PARAM>
 <!-- commentaires -->                
 <!-- commentaire manager -->
 <GRP ID="EVA5_3" SIZE="3">
    <FLD NAME="EVACMTNEW">$avism</FLD>
 </GRP>
 <!-- commentaire collaborateur -->
 <GRP ID="EVA5_4">
    <FLD NAME="CMTMATNEW">$avisc</FLD>
 </GRP>           
 <!-- Activitée du salarié -->     
 <!-- compétences  -->                
 <GRP ID="ZEV1_1">
    <FLD NAME="ZCOMPCLE">$competence</FLD>            
 </GRP>
 <!-- faits marquants -->
 <GRP ID="ZEV1_1">
    <FLD NAME="ZFAITS">$faitmarquant</FLD>            
 </GRP>
 <!-- interets -->                
 <GRP ID="ZEV1_1">
    <FLD NAME="ZINTERETS">$interet</FLD>            
 </GRP>  
 <!-- beosoin pro -->
 <GRP ID="ZEV1_2">
    <FLD NAME="ZPROJET">$besoinpro</FLD>
 </GRP>
 <GRP ID="ZEV1_2">
    <FLD NAME="ZFREINS">$frein</FLD>
 </GRP>
 <GRP ID="EVA8_1">
    <FLD NAME="PRJPFL">$projetpro</FLD>
 </GRP>
</PARAM>
XML;

        $client = new soapclient($uri);
        $result = $client->modify($CallContext, "ZEVA", $Cles, $xml);

        return $result;
    }

    public function getRecherche($annee, $validC, $validM, $validRH) {
        include "include.php";

        $xml = <<<XML
<PARAM>
	
</PARAM>

XML;

        $client = new soapclient($uri);
        $result = $client->run($CallContext, "ZRECHAJAX", $xml);
        $xml = simplexml_load_string($result->resultXml);

        return new SimpleXMLElement($result->resultXml);
    }

    public function newDemandeFormation() {
        include "include.php";

        $xml = <<<XML
<PARAM>
	<GRP ID="DEM0_1" >
		<FLD NAME="DEMNUM" >00000006</FLD>
	</GRP>
	<GRP ID="DEM1_2" >
		<FLD NAME="REFNUM" TYPE="Char" >1790</FLD>
	</GRP>
	<TAB DIM="100" ID="DEM3_1" SIZE="1" >
		<LIN NUM="1" >
			<FLD NAME="ORGFIN" TYPE="Char" >TEST</FLD>
		</LIN>
	</TAB>
</PARAM>
        
XML;

        $client = new soapclient($uri);
        $result = $client->save($CallContext, "ZDEM", $xml);        

        return $result;
    }

}
