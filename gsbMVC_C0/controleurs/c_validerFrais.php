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
}

?>