//core.inc.php
<?php

function head()
{
    echo '<html>
                <head>
                    <title>Vote en ligne</title>
                    <link rel="stylesheet" type="text/css" href="css/style.css">';
    echo '</head><body>';

    echo ' <div class="site"> <div class="vote-header"> <div class="header content">';
}

function insererImage()
{
    $jour = Date('d');
    $mois = Date('m');
    $annee = Date("Y");
    echo "<a class=\"lien-vote\" href=\"index.php\"><img class=\"a-logo\" src=\"images/logo.jpg\" width=\"100\" height=\"74\"></a>";

}

function userbox()
{
	$id_user = $_SESSION['id'];
    echo '<div class="userbox">    <div class="name">';
        $prenom = $_SESSION['prenom'];
        echo "<a class=\"name\" href=\"profil.php\">$prenom</a>";
  echo'  </div>
		<ul class="usernav">
			<li> <a href="index.php"> Acceuil </a></li>';
			if($id_user == 1)
			{
				echo"<li><a href=\"proposition.php\"> Sujet proposer </a></li>";
				echo"<li><a href=\"insererVote.php\"> Ajouter un Vote </a></li>";
			}
			else
			{	
				echo "<li><a href=\"proposerVote.php\"> Proposer Vote </a></li>";
				echo"<li><a href=\"message.php\"> Messagerie </a></li>";
			}
			echo'<li><a href="resultat.php"> Resultats </a></li>
			<li><a href="compte.php"> Gestion du compte </a></li>
			<li><a href="deconnexion.php"> Deconnexion </a></li>
        	</ul>
	</div></div>';
        
        recherche();
    echo'</div>';
}

 function recherche()
 {
     echo '<div class="recherche">
                    <form id="recherche" method="get" action="recherche.php">
                        <input type="text" name="search" value=""  placeholder="Rechercher..." />
                    </form>
               </div>';
 }

function footer()
{
    echo ' <div class="vote-footer1"><div class="footer content"> Projet 2011 // raphael aupee </div></div> </div></body></html>';
}

function footerMobile()
{
    echo ' <div class="vote-footer2"><div class="footer content"> Projet 2011 // raphael aupee </div></div> </div></body></html>';
}

function redirect($url)
{
    header("Location: $url");
    exit();
}

function modif_int($int)
{
    $int = intval($int);
    if ($int < 10 && $int != 0)
    {
        $int = '0' . $int;
    }
    return $int;
}


function div_special($texte)
{
    if ($texte == 'inscription')
    {
         echo '<div class ="special_marche">';
        echo 'Inscription réussi !';
        echo '<a href="index.php"> Connectez-vous ! </a>';
    }
    else
    {
        echo '<div class ="special_erreur">';
        if ($texte == 'pasenvoye')
            echo 'Les informations n\'ont pas été envoyé';
        else if ($texte == 'verif')
            echo 'Les deux mots de passe sont différents';
        else if ($texte == 'pasrempli')
            echo 'Veuillez entrer toutes les informations';
        else if ($texte == 'longmdp')
            echo 'Mot de passe est de mauvaise taille';
        else if ($texte == 'nomfaux')
            echo 'Mauvais Nom';
        else if ($texte == 'prenomfaux')
            echo 'Mauvais Prenom';
        else if ($texte == 'emailfaux')
            echo 'Mauvais Email';
        else if ($texte == 'emaillong')
            echo 'Email trop long';
        else if ($texte == 'emailUsed')
            echo 'Email déjà Utilisé';
        else if ($texte == 'personneUsed')
            echo 'Le nom ou le prenom est déjà utilisé';

        echo '</div>';
    }
}

function div_test($nom, $prenom, $email)
{
     echo '<div class ="special">';
    echo "$nom $prenom $email";
    echo '</div>';
}
?>
