<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idComptable = $_SESSION['idComptable'];
switch($action){
	case 'choisirVisiteur' :{
		$lesVisiteurs = $pdp-> getLesVisiteurs($idComptable);
		$lesCles = array_keys($lesVisiteurs);
		$visiteurASelectionner = $lesCles[0];
		include("vues/v_listeVisiteur.php");
		break;
	}
	case 'selectionnerMois':{
		$leVisiteur = $_REQUEST['lstVisiteur']
		$lesMois = $pdo->getLesMoisDisponibles($leVisiteur);
		$lesCles = array_keys($lesMois);
		if ($lesCles != null) {
			$moisASelectionner = $lesCles[0];
			include("vues/v_listeMois.php");
		}
		
		break;
	}

	case 'voirEtatFrais':{
		/*$idVisiteur = $_SESSION['id'];
		$leMois = $_REQUEST['lstMois']; 
		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		$idVisiteur = $_SESSION['id'];
		$moisASelectionner = $leMois;
		include("vues/v_listeMois.php");*/

		$leMois = $_REQUEST['lstMois'];
		$_SESSION['mois'] = $leMois;
		$idVisiteur = $_SESSION['id'];
		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		$moisASelectionner = $leMois;
		include("vues/v_listeMois.php");

		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_etatFrais.php");
		break;
	}

	case 'refusFrais':{
        $idFrais = $_REQUEST['idFrais'];
        $_SESSION['id'] = $idFrais;
        $pdo->refuserFraisHorsForfait($idFrais);
	
	    $leMois = $_SESSION['mois'];
	    $idVisiteur = $_SESSION['id'];
	    $numAnnee =substr( $leMois,0,4);
	    $numMois =substr( $leMois,4,2);
	    
	    /*$montant = $pdo->getLeMontantTotal($idVisiteur,$leMois);
	    $pdo->majFicheFraisMontant($idVisiteur,$leMois,$montant);*/
	    
	    $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
	    $moisASelectionner = $leMois;
	    include("vues/v_listeMois.php");
	    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
	    $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
	    $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
	    $numAnnee =substr( $leMois,0,4);
	    $numMois =substr( $leMois,4,2);
	    $libEtat = $lesInfosFicheFrais['libEtat'];
	    $montantValide = $lesInfosFicheFrais['montantValide'];
	    $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
	    $dateModif =  $lesInfosFicheFrais['dateModif'];
	    $dateModif =  dateAnglaisVersFrancais($dateModif);
	    include("vues/v_etatFrais.php");
	    ?> <meta http-equiv="refresh" content="0; url=index.php?uc=etatFrais&action=selectionnerVisiteur" /> <?php
	    break;
	}

	case 'repoterFraisHorsForfait' :{
	    $idFrais =$_SESSION['id'];
	    $leMois = $_SESSION['mois'];
	    $idVisiteur = $_SESSION['id'];
	    $numAnnee =substr( $leMois,0,4);
	    $numMois =substr( $leMois,4,2);
	    
	    $pdo->supprimerFraisHorsForfait($idFrais);
	    /*$montant = $pdo->getLeMontantTotal($idVisiteur,$leMois);
	     $pdo->majFicheFraisMontant($idVisiteur,$leMois,$montant);*/
	    
	    $date = $_REQUEST['date'];
	    $libelle = $_REQUEST['libelle'];
	    $leMontant = $_REQUEST['montant'];
	    
	    $moisSuivant = moisSuivant($leMois);
	    if ($pdo->dernierMoisSaisi($idVisiteur) == $leMois){
	        
	        $pdo->creeNouvellesLignesFrais($idVisiteur,$moisSuivant);
	    }
	    
	    $pdo->creeNouveauFraisHorsForfait($idVisiteur,$moisSuivant,$libelle,$date,$leMontant);
	    /*$montant = $pdo->getLeMontantTotal($idVisiteur,$moisSuivant);
	     $pdo->majFicheFraisMontant($idVisiteur,$moisSuivant,$montant);*/
	    
	    $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
	    $moisASelectionner = $leMois;
	    include("vues/v_listeMois.php");
	    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
	    $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
	    $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
	    $numAnnee =substr( $leMois,0,4);
	    $numMois =substr( $leMois,4,2);
	    $libEtat = $lesInfosFicheFrais['libEtat'];
	    $montantValide = $lesInfosFicheFrais['montantValide'];
	    $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
	    $dateModif =  $lesInfosFicheFrais['dateModif'];
	    $dateModif =  dateAnglaisVersFrancais($dateModif);
	    include("vues/v_etatFrais.php");
	    
	    break;
	}

	case'actualiser' : {
	    $leMois = $_SESSION['mois'];
	    $idVisiteur = $_SESSION['id'];
	    $numAnnee =substr( $leMois,0,4);
	    $numMois =substr( $leMois,4,2);
	    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur,$leMois);
	    include("vues/v_listeFraisForfait.php");
	    
	    break;
	}
	case 'majFraisForfait':{
	    $leMois = $_SESSION['mois'];
	    $idVisiteur = $_SESSION['id'];
	    $numAnnee =substr( $leMois,0,4);
	    $numMois =substr( $leMois,4,2);
	    $lesFraisForfait = $_REQUEST['lesFrais'];
	    
	    if(lesQteFraisValides($lesFraisForfait)){
	        $pdo->majFraisForfait($idVisiteur,$leMois,$lesFraisForfait);
	        /*$montant = $pdo->getLeMontantTotal($idVisiteur,$leMois);
	        $pdo->majFicheFraisMontant($idVisiteur,$leMois,$montant);*/
	    }
	    else { 
	        ajouterErreur("Les valeurs des frais doivent etre numeriques");
	        include("vues/v_erreurs.php");
	    }
	    $lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
	    $moisASelectionner = $leMois;
	    include("vues/v_listeMois.php");
	    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
	    $lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
	    $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
	    $numAnnee =substr( $leMois,0,4);
	    $numMois =substr( $leMois,4,2);
	    $libEtat = $lesInfosFicheFrais['libEtat'];
	    $montantValide = $lesInfosFicheFrais['montantValide'];
	    $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
	    $dateModif =  $lesInfosFicheFrais['dateModif'];
	    $dateModif =  dateAnglaisVersFrancais($dateModif);
	    include("vues/v_etatFrais.php");
	    
	    break;
	}

	case 'validerFrais':{
		$idVisiteur = $_SESSION['id'];
		$mois = $_REQUEST['mois'];
		$pdo->majEtatFicheFrais($idVisiteur,$mois);
		echo "Les fiches ont été passé de l'état CL à l'état VA";
		//echo $idVisiteur;
		break;
	}
}

?>