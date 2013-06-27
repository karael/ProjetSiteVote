//accepter.php
<?php
session_start();

include 'core.inc.php';
include 'interactionDB.inc.php';
head();
insererImage();
userbox();

if (!$_SESSION)
    redirect("index.php");
    
if (isset($_GET['id_vote']) && isset($_GET['type']))
{
    $id_du_vote = htmlspecialchars($_GET['id_vote']);
    $type_vote = htmlspecialchars($_GET['type']);
    $reponse = getReponse($id_du_vote);
    $titre_du_vote = getTitreVote($id_du_vote);

    
    
	echo '
<div class=\'main content\'>
    <div class="header-main">';
    echo "<h1>Vous voici sur la page des votes que l'on vous propose </h1> ";
    echo '<h3>choisissez de les accépter ou de les refuser</h3>';
    echo'    </div>
    <div class="presentation">
        <div class="listeVote">';
	echo "
		<table>
			<thead>
				<tr>
					<th> $titre_du_vote </th>
				</tr>
			</thead>
			<tbody>";
				foreach($reponse AS $attribut => $valeur)
				{
					foreach($valeur AS $att =>$val)
					{
						if($att == 'id_reponse')
							$id_reponse = $val;
						if($att == 'nom_rep')
							$nom_de_la_reponse = $val;
						if($att == 'id_vote')
							$id_vote = $val;
					}
					 echo" 
					       <tr>
							<td>",  $nom_de_la_reponse,"</td>   
						 </tr>";
				}
				    echo "
						<tr>
							<td> <center><a href='accepter.php?rep=accepter&id_vote=$id_du_vote'> <input type='button' onclick='' value='Accepter'></a>
							<a href='accepter.php?rep=refuse&id_vote=$id_du_vote'> <input type='button' onclick='accepter.php?rep=refuse' value='Refuser'></a></center> </td>  
						 </tr>
			</tbody>
		</table>";
			echo '
       </div>
    </div>
</div>';

}
$reponse = (isset($_GET['rep'])) ? $_GET['rep'] : '';
if($reponse == "accepter")
{
	$id_vote = htmlspecialchars($_GET['id_vote']);
	$visible = 1;
	accepteVote($id_vote, $visible);
	$id_user = getIdUser($id_vote);
	$objet = getTitreVote($id_vote);
	$valeur = 1;
	nouveauMsg($id_user, $objet, $valeur);
	redirect("index.php");
}

if($reponse == "refuse")
{
	$id_vote = htmlspecialchars($_GET['id_vote']);
	$valeur = 0;
	$id_user = getIdUser($id_vote);
	$objet = getTitreVote($id_vote);
	nouveauMsg($id_user, $objet, $valeur);
	supprimerVote($id_vote);
	redirect("index.php");
}

footerMobile();
?>