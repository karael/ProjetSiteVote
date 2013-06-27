//profil.php
<?php
session_start();

include 'core.inc.php';
include 'interactionDB.inc.php';

if (!$_SESSION)
    redirect("index.php");

$id_user = $_SESSION['id'];
$nom_user = $_SESSION['nom'];
$prenom_user = $_SESSION['prenom'];
$email_user = $_SESSION['email'];
$is_vous = true;

if (isset($_GET['nom']) && isset($_GET['prenom']))
{
    $nom_user = htmlspecialchars($_GET['nom']);
    $prenom_user = htmlspecialchars($_GET['prenom']);
    $info_user = infoCompteviaPersonne($nom_user, $prenom_user);
    
    if ($info_user)
    {
        $id_user = $info_user['id'];
        if ($id_user == $_SESSION['id'])
            redirect("profil.php");

        $email_user = $info_user['email'];
        $is_vous = false;
    }
    else
        redirect("profil.php?error=personne");
}

head();
insererImage();
userbox();
?>

<script language=javascript>
    function redirige(personne, nom, prenom)
    {
        if (personne == 'user')
            document.location = "compte.php";
        else if (personne == 'non_contact')
            document.location = "ajoutContact.php?nom=" + nom + "&prenom=" + prenom;
    } 

</script>

<div class="main content">
    <div class="header-main">
        <?php 
		if (isset($_GET['error']) && $_GET['error'] == 'personne')
		{
			echo '<h1><strong><font color="red">Cette Personne n\'existe pas</font></strong></h1>';
		}
		else
		{

			echo '<h1><strong>' . $nom_user . ' ' . $prenom_user . '</strong></h1>';

			if ($is_vous == true)
			{
			    echo '<ul class="profil">
					<li class="texteProfil">
					    C\'est vous ! 
					</li>
					<li class="bouton">
					    <input type="button"  value="Editez votre profil !" onclick="redirige(\'user\')">
					</li>
				    </ul>
				</div>';
			}
			else
				echo '<br />';
				echo '<hr />
				<div class="presentation">
				<div class="info">';
			echo "<table> <tbody><tr><td class='caract'> Nom : </td><td> $nom_user </td> </tr> <tr><td class='caract'> Prenom : </td><td> $prenom_user </td></tr><tr><td class='caract'> Email : </td><td> $email_user </td></tr>";

			echo ' </tbody></table></div>';

			
		}
		footerMobile();
    ?>
