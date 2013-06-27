//insereVote1.php
<?php

session_start();

include 'core.inc.php';
include 'interactionDB.inc.php';

if (!$_SESSION)
redirect("index.php");


head();
insererImage();
userbox();

echo' 
<div class="profiltab content">
<div class = ajoutVote>
<div class = production-info Vote>
<h3> Ajouter un vote à choix unique</h3>
	<p>Vous avez choisie d\'ajouter un vote à choix unique </p>
	<div class="formulaire">
	<form id="ajout_vote" method="post" action="insererVote1.php?action=inserVote">
            <table>
                <tbody>
                    <tr>
                        <td> Sujet :</td> 
                        <td> <input id="sujet" type="text" value="" name="sujet" ></td>
                    </tr>
                    <tr>
                <td> Date debut ( <strong> aaaa-mm-jj </strong>) : </td>
                <td> <input id="dateD" type="text" value="" name="dateD" ></td>
                    </tr>
                <tr>
                    <td> Date fin ( <strong> aaaa-mm-jj</strong> ) :</td>
                    <td> <input id="dateF" type="text" value="" name="dateF"></td>
                </tr>
                <tr>
                    <td> Reponse 1: </td>
                    <td> <input id="rep1" type = "text" name="rep1" required> </td>
                </tr>
                <tr>
                    <td> Reponse 2: </td>
                    <td> <input id="rep2" type = "text" name="rep2" required> </td>
                </tr>
                <tr>
                    <td> Reponse 3: </td>
                    <td> <input id="rep3" type="text" name="rep3"> </td>
                </tr>
		  <tr>
                    <td> Reponse 4: </td>
                    <td> <input id="rep4" type="text" name="rep4"> </td>
                </tr>
                <tr>
                    <td> <input id="ajouterVote1" type="submit" value="Ajouter le Vote" name="ajou1"></td>
                </tr>
                </tbody>
            </table>
        </form>
	</div>
</div> </div>
</div>';


$id_users = $_SESSION['id'];

$action = (isset($_GET['action'])) ? $_GET['action'] : '';



if($action == "inserVote")
{
	$titre = $_POST["sujet"];
	$type = 1;
	$date_debut = $_POST["dateD"];
	$date_fin = $_POST["dateF"];
	$ajout = true;
	$visible= 1;
	if(isset($titre) && empty($titre) )
	{
		echo "<div class='special_erreur'> Veuillez remplir le titre du sondage</div>";
		$ajout = false;
	}
	if(isset($date_debut) && empty($date_debut) && $ajout == true)
	{
		echo "<div class='special_erreur'> Veuillez remplir la date de début du sondage</div>";
		$ajout = false;
	}
	if(isset($date_fin) && empty($date_fin) && $ajout == true )
	{
		echo "<div class='special_erreur'> Veuillez remplir la date de fin du sondage</div>";
		$ajout = false;
	}
	
	if ($ajout == true)
	{
		ajouterVote($titre, $type, $date_debut, $date_fin, $visible);
		echo "<div class='special_marche'> Votre vote à bien été ajouter </div>";
	}
	
	
	$reponse1 = $_POST["rep1"];
	$reponse2 = $_POST["rep2"];
	$reponse3 = $_POST["rep3"];
	$reponse4 = $_POST["rep4"];
	
	
	$id_vote = getIdVote($titre);
	$nb_vote = 0;
	if($ajout == true)
	{
		ajouterReponse($id_vote, $reponse1, $nb_vote);
		ajouterReponse($id_vote, $reponse2, $nb_vote);
		if (isset($reponse3) && !empty($reponse3))
		{
			ajouterReponse($id_vote, $reponse3, $nb_vote);
		}
		
		if (isset($reponse4) && !empty($reponse4))
		{
			ajouterReponse($id_vote, $reponse4, $nb_vote);
		}
	}
	
}
	
	
footer();
?>