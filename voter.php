//voter.php
<?php

session_start();

include 'core.inc.php';
include 'interactionDB.inc.php';

if (!$_SESSION)
redirect("index.php");


head();
insererImage();
userbox();

if (!isset($_GET['id_vote']))
{
	$nom_rep = $_POST['rep'];
	//echo $nom_rep;

	$id_reponse = getIdReponse($nom_rep);
	$id_vote = getIdVote2($id_reponse);
	$nb_rep = getNbVote($id_reponse);
	$nb_rep = $nb_rep + 1;
	voter($id_reponse, $nb_rep);
	redirect("resultat.php?id_vote=$id_vote");
}
else if(isset($_GET['id_vote'])&& !isset($_GET['type']))
{
	$id_du_vote = htmlspecialchars($_GET['id_vote']);
	$reponse = getReponse($id_du_vote);
	$nom_rep = $_POST['repV'];
	foreach ($nom_rep as $elem) {
		$id_reponse = getIdReponse($elem);
		$id_vote = getIdVote2($id_reponse);
		$nb_rep = getNbVote($id_reponse);
		$nb_rep = $nb_rep + 1;
		voter($id_reponse, $nb_rep);
	}
	redirect("resultat.php?id_vote=$id_vote");
}
else if(isset($_GET['id_vote'])&& isset($_GET['type']))
{
	$nom_reponse = $_POST['reponse'];
	$nb  = getReponseExist($nom_reponse);
	$id_vote = htmlspecialchars($_GET['id_vote']);
	if($nb == 0)
	{
		ajouterReponse($id_vote, $nom_reponse, 1, true);
	}
	else
	{
		$id_reponse = getIdReponse($nom_reponse);
		$nb_rep = getNbVote($id_reponse);
		$nb_rep = $nb_rep + 1;
		voter($id_reponse, $nb_rep);
	}
	redirect("resultat.php?id_vote=$id_vote");
}
else
redirect("resultat.php");

footer();
?>