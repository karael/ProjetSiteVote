//resultat.php
<?php
session_start();

include 'core.inc.php';
include "interactionDB.inc.php";

head();

insererImage();

userbox();

$id_user = $_SESSION['id'];
//calcul et affichage des resultats

if (isset($_GET['id_vote']))
{
	$id_du_vote = htmlspecialchars($_GET['id_vote']);
	$titre_du_vote = getTitreVote($id_du_vote);
	$reponse = getReponse($id_du_vote);
	$nb_votes = 0;
	foreach($reponse AS $attribut => $valeur)
	{
		foreach($valeur AS $att =>$val)
		{
			if($att == 'nombre_vote')
				$nb =$val;
		}
		$nb_votes += $nb;
	}
	echo '
	<div class=\'main content\'>
	<div class="header-main">';
	echo "<h1>Voici les resultats du moment, pour ", $titre_du_vote,":</h1> ";
	echo'    </div>
	<div class="presentation">
        <div class="listeVote">';
	 echo '
            <table>
                <thead>
                    <tr>
                        <th></th>
                    </tr>
                </thead>
                <tbody>';
	foreach($reponse AS $attribut => $valeur)
	{
		foreach($valeur AS $att =>$val)
		{
			if($att == 'nombre_vote')
				$nb_vote_en_cours = $val;
			if($att == 'nom_rep')
				$nom_rep = $val;
		}
		$pourcent= ($nb_vote_en_cours / $nb_votes) * 100;
		$pourcent = number_format($pourcent, 2);
		echo "
                               <tr>
                                        <td>$nom_rep </td>  
					<td> $pourcent % des votes</td>
                                 </tr>";
	}
	echo '
                            </tbody>
                        </table>';
			echo '
       </div>
    </div>
</div>';
}
else
{
	echo '
<div class=\'main content\'>
    <div class="header-main">';
    echo "<h1>Voici la liste des resultats du moment, </h1> ";
    echo '<h3>choisissez ceux qui vous intéresse </h3>';
    echo'    </div>
    <div class="presentation">
        <div class="listeVote">';
	$vote = getVote();
	if(!$vote)
		echo'<li> Aucun resultats en ce moment </li>';
	else
	{	
		if (sizeof($vote) == 0)
			echo'<li> Aucun resultats en ce moment </li>';
	else
	{
                echo '
            <table>
                <thead>
                    <tr>
                        <th> Liste des resultats </th>
                    </tr>
                </thead>
                <tbody>';
		foreach($vote AS $attribut => $valeur)
		{
			foreach($valeur AS $att =>$val)
			{
				if($att == 'id_vote')
					$id_du_vote = $val;
				if($att == 'date_fin')
					$date_fin_vote = $val;
				if($att == 'titre')
					$titre_vote = $val;
				if($att == 'type')
					$type_vote = $val;
			}
			echo "
                               <tr>
                                        <td> <a href='resultat.php?id_vote=$id_du_vote&type=$type_vote'> $titre_vote </a></td>  
                                 </tr>";
		}
                    echo '
                            </tbody>
                        </table>';
	}
		echo '
       </div>
    </div>
</div>';
	}
}

footer();

?>