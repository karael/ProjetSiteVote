//recherche.php
<?php
session_start();

include 'core.inc.php';
include 'interactionDB.inc.php';
head();
insererImage();
userbox();

if (!$_SESSION)
    redirect("index.php");
    
$date= date("Y-m-d");
    
 $nom = $_GET['search'];
 $resultat_recherche = recherche2($nom);

	echo '
<div class=\'main content\'>
    <div class="header-main">';
    echo "<h1>Voici le résultats de votre recherche</h1> ";
    echo '<h3>Vous pouvez soit aller au vote pour voter soit allez directement au résultat !!</h3>';
    echo'    </div>
    <div class="presentation">
        <div class="listeVote">';
	echo "
		<table>
			<thead>
				<tr>
					<th> Titre du vote </th>
					<th> Aller au vote </th>
					<th> Aller au résultat </th>
				</tr>
			</thead>
			<tbody>";
				foreach($resultat_recherche AS $attribut => $valeur)
				{
					foreach($valeur AS $att =>$val)
					{
						if($att == 'id_vote')
							$id_vote = $val;
						if($att == 'titre')
							$titre = $val;
						if($att == 'date_fin')
							$date_fin = $val;
						if($att == 'date_debut')
							$date_debut = $val;
						if($att == 'type')
							$type = $val;
					}
					$date = explode("-", $date);
					$date_fin = explode( "-", $date_fin );
					@$date = $date[0].$date[1].$date[2];
					$date_fin = $date_fin[0].$date_fin[1].$date_fin[2];
					if($date_fin > $date)
					{
						echo" 
						       <tr>
								<td>",  $titre,"</td>   
								<td>  <center><a href='vote.php?id_vote=$id_vote&type=$type'> <input type='button' onclick='' value='Vote'></a></center></td>
								<td>  <center><a href='resultat.php?id_vote=$id_vote&type=$type'> <input type='button' onclick='' value='Résultats'></a></center></td>
							 </tr>";
					}
					else
					{
						echo" 
						       <tr>
								<td>",  $titre,"</td>   
								<td>  <center>Vote finni</center></td>
								<td>  <center><a href='resultat.php?id_vote=$id_vote&type=$type'> <input type='button' onclick='' value='Résultats'></a></center></td>
							 </tr>";
					}
				}
				    echo "
						
			</tbody>
		</table>";
			echo '
       </div>
    </div>
</div>';



footerMobile();
?>