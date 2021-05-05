<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idComptable = $_SESSION['idComptable'];
switch($action){
	case 'choisirVisiteur' :{
		$lesVisiteurs = $pdo-> getLesVisiteurs($idComptable);
		$lesCles = array_keys($lesVisiteurs);
		$visiteurASelectionner = $lesCles[0];
		include("vues/v_listeVisiteur.php");
		break;
	}
	case 'selectionnerMois':{
		$leVisiteur = $_REQUEST['listeVisiteur'];
		$_SESSION['id'] = $leVisiteur;
		$lesMois = $pdo->getLesMoisDisponibles($leVisiteur);
		$lesCles = array_keys($lesMois);
		
		include("vues/v_listeMois.php");
		break;
		
		
		
	}
	
	case 'voirEtatFrais':{
		$idVisiteur = $_SESSION['id'];
		$leMois = $_REQUEST['lstMois']; 
		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		$idVisiteur = $_SESSION['id'];
		
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
		echo 'dvfhvdf';
		$idFrais = $_REQUEST['idFrais'];
	    $idFrais = $pdo->refuserFraisHorsForfait($idFrais);

		break;
	}

	case 'validerFrais':{
		$idVisiteur = $_SESSION['id'];
		$mois = $_REQUEST['mois'];
		$valider = $pdo->majEtatFicheFrais($idVisiteur,$mois);
		echo "Les fiches ont été passé de l'état CL à l'état VA";
		echo $idVisiteur;
		break;
	}


	case 'voirFrais':{
		$idVisiteur = $_SESSION['id'];
		$lesLignes = $pdo->getFicheFrais();
		include("vues/v_listeFrais.php");
		break;

	}


	case 'etatFraisRB':{
		$idVisiteur = $_SESSION['id'];
		$mois = $_REQUEST['mois'];
		$remboursement = $pdo->majEtatFicheRB($idVisiteur, $date);
		echo "Le remboursement a bien été effectué";
		include("vues/v_listeFrais.php");
		break;
	}

}
?>