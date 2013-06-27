<?php

session_start();

include 'core.inc.php';
include 'interactionDB.inc.php';

if (!$_SESSION)
redirect("index.php");


head();
insererImage();
userbox();

 
echo' 
<div class="profiltab content">
<div class = ajoutVote>
<div class = production-info Vote>
<h3> Proposer un vote</h3>
	<p>Ceci vous permet de proposer un vote, vous êtes libres de choisir quel genre de vote vous voulez proposer</p>
	<div class="formulaire">
	 <span style="font-size:18px;">Choisissez un type de Vote !! </span><br /><br />
	<a href="ProposerVote1.php"><input type="button"  id="voteChoix1" value="Choix Unique" onclick="choixUnique()" /></a>
                    <span style="font-size:16px;"> ou</span>

	<a href="ProposerVote2.php"><input type="button"  id="voteChoix2" value="Choix Multiple" onclick="choixMulti()" /></a>
                    <span style="font-size:16px;"> ou</span>

	<a href="ProposerVote3.php"><input type="button"  id="voteChoix3" value="Choix libre" onclick="choixLibre()" /></a>
                    <span style="font-size:16px;"></span>
		    </div>
		    </div></div>
		    </div>';
footer();
?>
