//gestionaire.php
<?php

if (!$_SESSION)
redirect("index.php");

$nb_vote = nbVote();
$date= date("Y-m-d");

echo '
<div class=\'main content\'>
    <div class="header-main">';
    echo "<h1>Voici la liste des vote du moment, </h1> ";
    echo '<h3>choisissez ceux qui vous intéresse et voté. Bon vote à tous!!!</h3>';
    echo'    </div>
    <div class="presentation">
        <div class="listeVote">';
	$vote = getVote();
	if(!$vote)
		echo'<li> Aucun vote en ce moment </li>';
	else
	{	
		if (sizeof($vote) == 0 )
			echo'<li> Aucun vote en ce moment </li>';
            else
            {
                echo '
            <table>
                <thead>
                    <tr>
                        <th> Liste des votes </th>
			<th> Date limite de vote </th>
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
				if($att == 'date_debut')
					$date_debut_vote = $val;
				if($att == 'titre')
					$titre_vote = $val;
				if($att == 'type')
					$type_vote = $val;
				if($att == 'visible')
					$visibilite = $val;
			}
			$date_fin  = $date_fin_vote;
			$date_debut  = $date_debut_vote;
			$date = explode("-", $date);
			$date_fin = explode( "-", $date_fin );
			$date_debut = explode( "-", $date_debut );
			@$date = $date[0].$date[1].$date[2];
			$date_fin = $date_fin[0].$date_fin[1].$date_fin[2];
			$date_debut = $date_debut[0].$date_debut[1].$date_debut[2];
			if($date_debut <= $date && $date_fin >= $date && $visibilite ==1)
			{
				echo "
				       <tr>
						<td> <a href='vote.php?id_vote=$id_du_vote&type=$type_vote'> $titre_vote </a></td>   
						<td> $date_fin_vote </td>
					 </tr>";
			}

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

?>
