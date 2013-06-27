<?php
session_start();

include 'core.inc.php';
include "interactionDB.inc.php";

head();

insererImage();
userbox();
if (!$_SESSION)
redirect("index.php");

$nb_vote = nbVote();
$date= date("Y-m-d");

echo '
<div class=\'main content\'>
    <div class="header-main">';
    echo "<h1>Voici la liste des vote que l'on vous propose en ce moment, </h1> ";
    echo "<h3>choisissez d'accepter ceux qui vous intéresse et de refuser les autres</h3>";
    echo'    </div>
    <div class="presentation">
        <div class="listeVote">';
	$vote = getVote();
	if(!$vote)
		echo'<li> Aucun vote en ce moment </li>';
	else
	{	
		if (sizeof($vote) == 0)
			echo'<li> Aucun vote en ce moment </li>';
            else
            {
                echo '
            <table>
                <thead>
                    <tr>
                        <th> Liste des votes </th>
                    </tr>
                </thead>
                <tbody>';
		foreach($vote AS $attribut => $valeur)
		{
			$vide= false;
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
				if($att == 'visible')
					$visibilite = $val;
			}
			$date_fin  = $date_fin_vote;
			$date = explode("-", $date);
			$date_fin = explode( "-", $date_fin );
			@$date = $date[0].$date[1].$date[2];
			$date_fin = $date_fin[0].$date_fin[1].$date_fin[2];
			if($date_fin > $date && $visibilite == 2)
			{
				echo "
				       <tr>
						<td> <center><a href='accepter.php?id_vote=$id_du_vote&type=$type_vote'> $titre_vote </a></center></td>   
					 </tr>";
			}
		}
		if($vide == true)
			echo'<tr> <td><center> Aucun vote proposé en ce moment </center></td> </tr>';
		
                    echo '
                            </tbody>
                        </table>';
		}
		echo '
       </div>
    </div>
</div>';
	}
footer();
?>