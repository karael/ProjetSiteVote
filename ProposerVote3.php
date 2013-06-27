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
<h3> Proposer un vote à choix libre</h3>
	<p>Vous avez choisie de proposer un vote à choix libre </p>
	<div class="formulaire">
	<form id="modif_profil" method="post" action="ProposerVote3.php?action=inserVote">
            <table>
                <tbody>
                    <tr>
                        <td> Sujet :</td> 
                        <td> <input id="sujet" type="text" value="" name="sujet"></td>
                    </tr>
                    <tr>
                <td> Date debut ( jj/mm/aaaa ) : </td>
                <td> <input id="dateD" type="text" value="" name="dateD"></td>
                    </tr>
                <tr>
                    <td> Date fin ( jj/mm/aaaa ) :</td>
                    <td> <input id="dateF" type="text" value="" name="dateF"></td>
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

$id_users = $_SESSION['id'];

if($action == "inserVote")
{
	$titre = $_POST["sujet"];
	$type = 3;
	$date_debut = $_POST["dateD"];
	$date_fin = $_POST["dateF"];
	$ajout = true;
	$visible= 2;
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
		$id_vote = getIdVote($titre);
		ajouterProposition($id_users, $id_vote);
		echo "<div class='special_marche'> Votre vote à bien été ajouter </div>";
	}
}
footer();
?>