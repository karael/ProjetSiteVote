//interactionDB.inc.php
<?php

/**
 * se connecte a la DB
 * @return PDO 
 */
function connectionDB()
{
    try
    {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

        $db = new PDO('pgsql:host=woody;dbname=ar101518', 'ar101518', 'ridhoimi', $pdo_options);
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    return $db;
}

/**
 *return les informations sur le compte grace a un email
 * @param type $email
 * @return type 
 */
function infoCompteviaEmail($email)
{
    $db = connectionDB();
    $request = $db->prepare('SELECT id, nom, prenom, email FROM accounts WHERE email = :email');
    $request->execute(array(':email' => $email));
    $result = $request->fetch(PDO::FETCH_ASSOC);
    return $result;
}

/**
 * return les informations sur le compte grace a une personne
 * @param type $nom
 * @param type $prenom
 * @return type 
 */
function infoCompteviaPersonne($nom, $prenom)
{
    $db = connectionDB();
    $request = $db->prepare('SELECT id, nom, prenom, email FROM accounts WHERE nom = :nom AND prenom = :prenom');
    $request->execute(array(':nom' => $nom, 'prenom' => $prenom));
    $result = $request->fetch(PDO::FETCH_ASSOC);
    return $result;
}

/**
 * verifie
 * @param type $email
 * @param type $passwd
 * @return type 
 */
function verifCompte($email, $passwd)
{
    $db = connectionDB();
    $request = $db->prepare('SELECT * FROM accounts WHERE email = :email AND password = :passwd');
    $request->execute(array(':email' => $email, ':passwd' => $passwd));
    $result = $request->fetch(PDO::FETCH_ASSOC);

    return $result;
}

/**
 * Verifie si l'email n'est pas deja utilisé
 * @param type $email
 * @return type 
 */
function verificationEmail($email)
{
    $db = connectionDB();
    
    $requestEmail = $db->prepare('SELECT * FROM accounts WHERE email = :email');
    $requestEmail->execute(array(':email' => $email));
    $personne_cherche = $requestEmail->fetch(PDO::FETCH_ASSOC);

    if ($personne_cherche)
        return true;

    return false;
}

function verificationPersonne($nom, $prenom)
{
    $db = connectionDB();
    
    $requestNom = $db->prepare('SELECT * FROM accounts WHERE nom = :nom and prenom = :prenom');
    $requestNom->execute(array(':nom' => $nom, ':prenom' => $prenom));
    $personne_cherche = $requestNom->fetch(PDO::FETCH_ASSOC);

    if ($personne_cherche)
        return true;
    
    return false;
}

function verifAncienPassword($id, $password)
{
    $db = connectionDB();
    
    $requestNom = $db->prepare('SELECT * FROM accounts WHERE id=:id and password=:password');
    $requestNom->execute(array(':id' => $id, ':password' => $password));
    $personne_cherche = $requestNom->fetch(PDO::FETCH_ASSOC);
    
    if ($personne_cherche)
        return true;
    
    return false;
}



function inscription($nom, $prenom, $email, $password)
{
    $db = connectionDB();

    $request = $db->prepare('INSERT INTO accounts(nom, prenom, email, password) VALUES (:nom, :prenom,  :email, :password)');
    $request->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':password' => $password));
}





function modifierCompte($entree, $valeur, $id)
{
     $db = connectionDB();
     
     $request = $db->prepare("UPDATE accounts SET $entree = :valeur WHERE id =:id;");
     $request->execute(array(':valeur' => $valeur, ':id' => $id));
}

function ajouterVote($titre, $type, $date_debut, $date_fin, $visible)
{
    $db = connectionDB();
    
    $request = $db->prepare('INSERT INTO vote(titre, type, date_debut, date_fin, visible) VALUES (:titre, :type, :date_debut, :date_fin, :visible)');
    $request->execute(array(':titre' => $titre,':type'=> $type, ':date_debut' => $date_debut, ':date_fin'=>$date_fin, ':visible'=> $visible));
}

function ajouterReponse($id_vote, $reponse, $nb_vote)
{
    $db = connectionDB();
    
    $request = $db->prepare('INSERT INTO reponse(id_vote, nom_rep, nombre_vote) VALUES (:id_vote, :nom_rep, :nombre_vote)');
    $request->execute(array(':id_vote' => $id_vote,':nom_rep'=> $reponse, ':nombre_vote' => $nb_vote));
}



function getIdVote($titre)
{
    $db = connectionDB();
    
    $request = $db->prepare('SELECT id_vote
                                            FROM vote
                                            WHERE titre = :titre');
    $request->execute(array(':titre' => $titre));
    $res = $request->fetch(PDO::FETCH_ASSOC);
	foreach ($res as $elem) {
		$num_vote = $elem;
	}

    return $num_vote;
}

function nbVote()
{
	$db = connectionDB();
	
	$request = $db->prepare('SELECT count(*) AS i
						FROM vote');
	$request->execute(array());
	$res = $request->fetchAll();
	return $res;
}

function getVote()
{
	$db = connectionDB();
	
	$request = $db->prepare('SELECT *
						FROM vote
						ORDER BY id_vote');
	$request->execute(array());
	$res = $request->fetchAll();
	
	return $res;
}

function getReponse($id_vote)
{
	$db = connectionDB();
	
	$request = $db->prepare('SELECT *
						FROM reponse
						WHERE id_vote = :id_vote
						ORDER BY nombre_vote');
	$request->execute(array(':id_vote' => $id_vote));
	$res = $request->fetchAll();
	
	return $res;
	
}


function getTitreVote($id_du_vote)
{
	$db = connectionDB();
	
	$request = $db->prepare('SELECT titre
						FROM vote
						WHERE id_vote = :id_vote');
	$request->execute(array(':id_vote' => $id_du_vote));
	$res = $request->fetch(PDO::FETCH_ASSOC);
	foreach ($res as $elem) {
		$titre_vote = $elem;
	}

    return $titre_vote;
}

function voter($id_rep, $nb_rep)
{
     $db = connectionDB();
     
     $request = $db->prepare("UPDATE reponse SET nombre_vote = :nb_rep WHERE id_reponse =:reponse;");
     $request->execute(array(':reponse' => $id_rep, ':nb_rep' =>$nb_rep));
}



function getIdVote2($id_reponse)
{
	$db = connectionDB();
	
	$request = $db->prepare('SELECT id_vote
						FROM reponse
						WHERE id_reponse = :id_rep');
	$request->execute(array(':id_rep' => $id_reponse));
	$res = $request->fetch(PDO::FETCH_ASSOC);
	foreach ($res as $elem) {
		$id_vote = $elem;
	}

    return $id_vote;
}


function getNbVote($id_reponse)
{
	$db = connectionDB();
	
	$request = $db->prepare('SELECT nombre_vote
						FROM reponse
						WHERE id_reponse = :id_rep');
	$request->execute(array(':id_rep' => $id_reponse));
	$res = $request->fetch(PDO::FETCH_ASSOC);
	foreach ($res as $elem) {
		$nb_vote = $elem;
	}

    return $nb_vote;
}

function getIdReponse($nom_reponse)
{
    $db = connectionDB();
    
    $request = $db->prepare('SELECT id_reponse
                                            FROM reponse
                                            WHERE nom_rep = :nom_rep');
    $request->execute(array(':nom_rep' => $nom_reponse));
    $res = $request->fetch(PDO::FETCH_ASSOC);
	foreach ($res as $elem) {
		$id_rep = $elem;
	}

    return $id_rep;
}

function getReponseExist($nom_reponse)
{
	$db = connectionDB();
	
	$request = $db->prepare('SELECT count(*)
						FROM reponse
						WHERE nom_rep = :nom_rep');
	$request->execute(array(':nom_rep' => $nom_reponse));
	$res = $request->fetch(PDO::FETCH_ASSOC);
	foreach ($res as $elem) {
		$nb_reponse_exist = $elem;
	}

    return $nb_reponse_exist;
}

function ajouterProposition($id_user, $id_vote)
{
    $db = connectionDB();
    
    $request = $db->prepare('INSERT INTO proposition(id_user, id_vote) VALUES (:id_user, :id_vote)');
    $request->execute(array(':id_user' => $id_user, ':id_vote' => $id_vote));
}

function accepteVote($id_du_vote, $visible)
{
	$db = connectionDB();
     
     $request = $db->prepare("UPDATE vote SET visible = :visible WHERE id_vote =:id_vote;");
     $request->execute(array(':id_vote' => $id_du_vote, ':visible' => $visible));
}

function supprimerVote($id_vote)
{
     $db = connectionDB();
     $request = $db->prepare('DELETE FROM vote WHERE id_vote = :id_vote');
     $request->execute(array(':id_vote' => $id_vote));
}


function getIdUser($id_vote)
{
	$db = connectionDB();
    
    $request = $db->prepare('SELECT id_user
                                            FROM proposition
                                            WHERE id_vote = :id_vote');
    $request->execute(array(':id_vote' => $id_vote));
    $res = $request->fetch(PDO::FETCH_ASSOC);
	foreach ($res as $elem) {
		$id_user = $elem;
	}

    return $id_user;
}

function nouveauMsg($id_user, $objet, $valeur)
{
	$db = connectionDB();
    
    $request = $db->prepare('INSERT INTO message(id_user, objet, valeur) VALUES (:id_user, :objet, :valeur)');
    $request->execute(array(':id_user' => $id_user, ':objet' => $objet, ':valeur' => $valeur));
}


function getMessage($id_users)
{
	$db = connectionDB();
	
	$request = $db->prepare('SELECT *
						FROM message
						WHERE id_user = :id_user');
	$request->execute(array(':id_user' => $id_users));
	$msg = $request->fetchAll();
	
	return $msg;
}

function recherche2($nom)
{
	$db = connectionDB();
	$nom = "%$nom%";
	$request = $db->prepare('SELECT *
						FROM vote
						WHERE (UPPER(titre) LIKE UPPER(:titre))');
	$request->execute(array(':titre' => $nom));
	$rst_rch = $request->fetchAll();
	
	return $rst_rch;
}

