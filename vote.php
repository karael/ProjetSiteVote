//vote.php
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

    
    
    if ($type_vote == 1)
    {
	echo '
<div class=\'main content\'>
    <div class="header-main">';
    echo "<h1>Vous voici sur la page de vote </h1> ";
    echo '<h3>choisissez la ou les reponse de votre choix et cliquer sur voter!!</h3>';
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
					}
					 echo" <form id='voter' method='post' action='voter.php'>
					       <tr>
							<td> <input type='radio' name='rep' value='$nom_de_la_reponse'>", $nom_de_la_reponse, "</td>   
						 </tr>";
				}
				    echo '
						<tr>
							<td> <center><input type=submit value="Voter"></center> </td>   
						 </tr>
			</tbody>
		</table>
			</form>';
			echo '
       </div>
    </div>
</div>';
	}
		
    
   else if ($type_vote == 2)
    {
	echo '
<div class=\'main content\'>
    <div class="header-main">';
    echo "<h1>Vous voici sur la page de vote </h1> ";
    echo '<h3>choisissez la ou les reponse de votre choix et cliquer sur voter!!</h3>';
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
					}
					 echo" <form id='voter' method='post' action='voter.php?id_vote=$id_du_vote'>
					       <tr>
							<td> <input type='checkbox' name=\"repV[]\" value='$nom_de_la_reponse'>", $nom_de_la_reponse, "</td>   
						 </tr>";
				}
				echo '
					<tr>
						<td> <center><input type=submit value="Voter"></center> </td>   
					</tr>
			</tbody>
		</table>
			</form>';
			echo '
       </div>
    </div>
</div>';
    }
    else if($type_vote == 3)
    {
	echo '
<div class=\'main content\'>
    <div class="header-main">';
    echo "<h1>Vous voici sur la page de vote </h1> ";
    echo '<h3>Ecrivé vous même la réponse de votre choix et cliquer sur voter!!</h3>';
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
	echo "<form id='voter' method='post' action='voter.php?id_vote=$id_du_vote&type=3'>
			<tr> <td> <center><input type='text' name='reponse'> </center> </td>  </tr>
			<tr> <td> <center><input type=submit value='Voter'></center> </td>   </tr>
			</tbody>
		</table>
			</form>";
			echo '
       </div>
    </div>
</div>';
    }
    else
	echo "<div class='special_erreur'> Ce vote n'existe pas veuillez retourner a l'accueil</div>";
}
footerMobile();
?>