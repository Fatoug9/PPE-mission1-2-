
<h3>Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> : 
    </h3>
    <div class="encadre">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?>
              
                     
    </p>
  	<table class="listeLegere">
  	   <caption>Eléments forfaitisés </caption>
        <tr>
         <?php
         foreach ( $lesFraisForfait as $unFraisForfait ) 
		 {
			$libelle = $unFraisForfait['libelle'];
		?>	
			<th> <?php echo $libelle?></th>
		 <?php
        }
		?>
		</tr>
        <tr>
        <?php
          foreach (  $lesFraisForfait as $unFraisForfait  ) 
		  {
				$quantite = $unFraisForfait['quantite'];
		?>
                <td class="qteForfait"><?php echo $quantite?> </td>
		 <?php
          }
		?>
    <th><a href="index.php?uc=etatFrais&action=actualiser" role="button">Actualiser</a></th>
		</tr>
    </table>
  	<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th> 
                <th class='supprimer'>Supprimer</th>                 
             </tr>
        <?php      
          foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
		  {
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
      $idFrais = $unFraisHorsForfait['id'];
      //$mois = $unFraisHorsForfait['mois'];
      
      
		?>
             <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td> 
                <td><a href="index.php?uc=etatFrais&action=refusFrais&idFrais=<?php echo $id ?>" role="button" 
                        onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Refuser</a></td> 
             </tr>
        <?php 
          }
		?>
    </table>
    <a href="index.php?uc=etatFrais&action=validerFrais" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Valider</a>

  </div>
  </div>
 






