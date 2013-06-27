//accueil.php
<html>
<head>
<title> Vote en ligne </title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="css/style.css">

<span class="inscription-logo">
    <a class="bouton" href='inscription.php'> 
        <img class="logo-inscription" src="images/compte.png">
    </a>
</span>
</div>
</div>
<div class="main content">
    <div class="connexion">
        <div class="box-connexion">
            <h2> Connexion</h2>
            <form method="post" action='connexion.php'>
                <label>
                    <strong class="email-label"> Email </strong>
                    <input id="Email" type="email" value="" name="email" required>
                </label>
                <label>
                    <strong class="password-label"> Mot de passe</strong>
                    <input id="Password" type="password" name="passwd" required>
                    <?php
                    if (isset($_GET['id']) &&  $_GET['id'] == 'fail')
                    {
                        echo '<span class="erreurmsg" role="alert">';
                        echo 'Le nom d\'utilisateur ou le mot de passe saisi est erroné.';
                        echo '</span>';
                    }
                   ?>
                </label>
                <input id="Connexion" type="submit" value="Connexion" name="connexion">
            </form>
        </div>
    </div>
    <div class="production-info agenda">
        <div class="production-header">
            <h1> sitevote </h1>
            <h2> Site de vote en ligne.</h2>
        </div>
        <ul class="liste">
            <li>
                <img alt="" src="images/vote2.jpg">
                <p class="titre"> <b>Vote </b></p>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </li>
            <li>
                <image alt="" src="images/sujet.gif">
                <p class="titre"> <b>Proposez vos idées </b></p>
                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </li>
        </ul>
    </div>
</div>
</body>
</html>
