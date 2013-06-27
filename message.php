//message.php
<?php
session_start();

include 'core.inc.php';
include 'interactionDB.inc.php';
head();
insererImage();
userbox();

if (!$_SESSION)
    redirect("index.php");
    
$id_users = $_SESSION['id'];
$message = getMessage($id_users);
if(!isset($_GET['valeur']))
{
echo '
<div class=\'main content\'>
    <div class="header-main">';
    echo "<h1>Vous voici sur votre messagerie </h1> ";
    echo '<h3>ici vous aurez les réponses aux votes que vous avez proposez!!</h3>';
    echo'    </div>
    <div class="presentation">
        <div class="listeVote">';
	echo "
		<table>
			<thead>
				<tr>
					<th><center> Vos messages</center> </th>
				</tr>
			</thead>
			<tbody>";
				foreach($message AS $attribut => $value)
				{
					foreach($value AS $att =>$val)
					{
						if($att == 'objet')
							$objet = $val;
						if($att == 'valeur')
							$valeur = $val;
					}
					 echo" 
					       <tr>
							<td> <center>Réponse à la proposition</td>  
							<td> <center><a href='message.php?valeur=$valeur'>", $objet,"</a></td>  
						 </tr>";
				}
				    echo "
						
			</tbody>
		</table>";
			echo '
       </div>
    </div>
</div>';
}
else
{
	echo'<div class="profiltab content">
<div class = ajoutVote>
<div class = production-info Vote>
	<h3> Voici la réponse à votre proposition</h3>
	<div class="formulaire">
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>';
	$valeur = htmlspecialchars($_GET['valeur']);
	if($valeur == 0)
	{
		echo"<h1><center>Vote en ligne vous remercie de participé au bon fonctionnement du site,<br>
					en proposant ce vote.<br>
					Malheuresement pour divers raisons nous ne pouvons accépter ce vote <br>
					Nous vous remercions encore pour votre proposition et vous invitons à proposer  <br>
					<tab><tab>de nouveaux vos idées.   Au revoir!!</center></h1>";
					
	}
	else
	{
		echo"<h1><center>Vote en ligne vous remercie de participé au bon fonctionnement du site,<br>
					en proposant ce vote.<br>
					Nous vous anonçons que nous avons accépté votre proposition. <br>
					Nous vous remercions encore pour votre proposition et vous invitons à proposer  <br>
					<tab><tab> de nouveaux vos idées.   Au revoir!!</center></h1>";
	}
	echo"
	<br>
	<br>
	<br>
	<br>
	<br>
	<a href='message.php'> <input type='button' onclick='' value='Retour au message'></a>
	<br>
	<br>
	<br>
	<br>
	<br>
	</div></div></div></div>";
	
}
footerMobile();
?>