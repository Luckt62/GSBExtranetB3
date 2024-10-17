<?php
include_once 'class.pdogsb.inc.php';
//on insère le fichier qui contient les fonctions


 /**
 * Teste si un quelconque visiteur est connecté
 * @return vrai ou faux 
 */
function estConnecte(){
  return isset($_SESSION['id']);
}
/**
 * Enregistre dans une variable session les infos d'un visiteur
 
 * @param $id 
 * @param $nom
 * @param $prenom
 */
function connecter($id,$nom,$prenom){
	$_SESSION['id']= $id; 
	$_SESSION['nom']= $nom;
	$_SESSION['prenom']= $prenom;
}


/* gestion des erreurs*/
/**
 * Indique si une valeur est un entier positif ou nul
 
 * @param $valeur
 * @return vrai ou faux
*/
function estEntierPositif($valeur) {
	return preg_match("/[^0-9]/", $valeur) == 0;
	
}

/**
 * Indique si un tableau de valeurs est constitué d'entiers positifs ou nuls
 
 * @param $tabEntiers : le tableau
 * @return vrai ou faux
*/
function estTableauEntiers($tabEntiers) {
	$ok = true;
	if (isset($unEntier) ){
		foreach($tabEntiers as $unEntier){
			if(!estEntierPositif($unEntier)){
		 		$ok=false; 
			}
		}	
	}
	return $ok;
}

/**
 * Ajoute le libellé d'une erreur au tableau des erreurs 
 
 * @param $msg : le libellé de l'erreur 
 */
function ajouterErreur($msg){
   if (! isset($_REQUEST['erreurs'])){
      $_REQUEST['erreurs']=array();
	} 
   $_REQUEST['erreurs'][]=$msg;
}
/**
 * Retoune le nombre de lignes du tableau des erreurs 
 
 * @return le nombre d'erreurs
 */
function nbErreurs(){
   if (!isset($_REQUEST['erreurs'])){
	   return 0;
	}
	else{
	   return count($_REQUEST['erreurs']);
	}
}


function input_data($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}


    
    function generateCode(){
          // Generate a 6 digits hexadecimal number
	  $numbytes = 3; // Because 6 digits hexadecimal = 3 bytes
	  $bytes = openssl_random_pseudo_bytes($numbytes); 
          $hex   = bin2hex($bytes);
	  return $hex;       
    }
    
	function portabiliter($id) {
		$pdo = PdoGsb::getPdoGsb();
        $result = $pdo->donneInfosportabilite($id);
		$fichier = "./portabilite/".$id.".json";
		file_put_contents($fichier, json_encode($result));
    }

	function verifiecode($id, $code) {
		$pdo = PdoGsb::getPdoGsb();
		$resultat = $pdo->recupereCode($id);
		if ($resultat) {
			if ($code == $resultat['code']) {
				$dateCreation = new DateTime($resultat['dateCreation']);
				$temps = new DateTime();
				$intervalle = $temps->diff($dateCreation);
				if ($intervalle->i < 1 && $intervalle->h == 0 && $intervalle->d == 0) {
					return true; 
				} else {
					return false; 
				}
			}
		}
		
		return false; 
	}
	
	
function ajouteConnexion($id){
	$pdo = PdoGsb::getPdoGsb();
	$_SESSION['Date'] = $pdo->ajouteConnexionInitiale($id);
}

function ajouteCode($id){
	$pdo = PdoGsb::getPdoGsb();
	$code = generateCode();
	$pdo->AjouterCodeVerif($id, $code);		
}

function envoyerEmail($destinataire, $sujet, $message) {
    $headers = 'From: lecnik.valentin@gmail.com' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    if (mail($destinataire, $sujet, $message, $headers)) {
        echo "Email envoyé avec succès à $destinataire.";
    } else {
        echo "L'envoi de l'email a échoué.";
    }
}
?>