<div id="contenu">
      <h2>Mes fiches de frais</h2>
      <h3>Visiteur à sélectionner : </h3>
      <form action="index.php?uc=etatFrais&action=selectionnerMois" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="listeVisiteur" accesskey="n">Visiteur : </label>
        <select id="listeVisiteur" name="listeVisiteur">
            <?php
			foreach ($lesVisiteurs as $Visiteur)
			{
			    $visiteur = $Visiteur['id'];
				$nom =  $Visiteur['nom'];
				$prenom =  $Visiteur['prenom'];
				if($visiteur == $visiteurASelectionner){
				?>
				<option selected value="<?php echo $visiteur ?>"><?php echo  $nom."/".$prenom ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo $visiteur ?>"><?php echo  $nom."/".$prenom ?> </option>
				<?php 
				}
			
			}
           
		   ?>    
            
        </select>
      </p>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>