<table class="listeLegere">
             <tr>
                <th class="visiteur">Visiteur</th>
                <th class="date">Date</th>
                <th class='etat'>Etat</th>   
                <th class='remboursement'>Remboursement</th>            
             </tr>
        <?php      
          foreach ( $lesLignes as $uneFicheFrais ) 
		  {
        
      $idVisiteur = $uneFicheFrais['id'];
      $visiteur = $uneFicheFrais['nom'];
      $date = $uneFicheFrais['dateModif'];
      $etat = $uneFicheFrais['idEtat'];
		?>
             <tr>
                <td><?php echo $visiteur ?></td>
                <td><?php echo $date ?></td>
                <td><?php echo $etat ?></td>
                <td><a href="index.php?uc=etatFrais&action=etatFraisRB&date=<?php echo $date ?>">Effectuer remboursement</a></td>
               
             </tr>
        <?php 
          }
		?>
</table>
