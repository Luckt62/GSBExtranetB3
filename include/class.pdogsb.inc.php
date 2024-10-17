<?php

/** 
 * Classe d'accès aux données.
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * @package default
 * @author Cheri Bibi
 * @version 1.0
 */

class PdoGsb {   		
    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=gsbextranet';   		
    private static $user = 'gsbextranetAdmin';    		
    private static $mdp = 'Valentin4&1312';	
    private static $monPdo;
    private static $monPdoGsb = null;
		
    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */				
    private function __construct() {
        PdoGsb::$monPdo = new PDO(PdoGsb::$serveur . ';' . PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
        PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
    }

    public function _destruct() {
        PdoGsb::$monPdo = null;
    }

    public static function getPdoGsb() {
        if (PdoGsb::$monPdoGsb == null) {
            PdoGsb::$monPdoGsb = new PdoGsb();
        }
        return PdoGsb::$monPdoGsb;  
    }

    /**
     * Vérifie si le login et le mot de passe sont corrects.
     * Utilise password_verify pour vérifier le mot de passe hashé.
     * @param string $login
     * @param string $pwd
     * @return bool
     * @throws Exception
     */
    public function checkUser($login, $pwd): bool {
        $user = false;
        $pdo = PdoGsb::$monPdo;
        $monObjPdoStatement = $pdo->prepare("SELECT motDePasse FROM medecin WHERE mail= :login AND token IS NULL");
        $monObjPdoStatement->bindValue(':login', $login, PDO::PARAM_STR);
        if ($monObjPdoStatement->execute()) {
            $unUser = $monObjPdoStatement->fetch();
            if (is_array($unUser)) {
                if (password_verify($pwd, $unUser['motDePasse'])) {
                    $user = true;
                }
            }
        } else {
            throw new Exception("Erreur dans la requête");
        }
        return $user;   
    }

    /**
     * Fonction pour valider les longueurs des champs nom et prénom.
     * @param string $nom
     * @param string $prenom
     * @throws Exception
     */
    public function verifierChamps($nom, $prenom) {
        // Vérification des longueurs de prénom et nom
        if (strlen($prenom) > 30) {
            throw new Exception("Le prénom ne doit pas dépasser 30 caractères.");
        }
        if (strlen($nom) > 40) {
            throw new Exception("Le nom ne doit pas dépasser 40 caractères.");
        }
    }

    /**
     * Crée un nouveau médecin avec les informations fournies.
     * Appelle la fonction de vérification pour nom et prénom.
     * @param string $email
     * @param string $mdp
     * @param string $nom
     * @param string $prenom
     * @return bool
     * @throws Exception
     */
    public function creeMedecin($email, $mdp, $nom, $prenom, $dateConsentement) {
        $this->verifierChamps($nom, $prenom);
        $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO medecin(id, mail, motDePasse, nom, prenom, dateCreation, dateConsentement) 
                VALUES (null, :leMail, :leMdp, :leNom, :lePrenom, now(), :dateConsentement)");
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $pdoStatement->bindValue(':leMail', $email);
        $pdoStatement->bindValue(':leMdp', $mdp);
        $pdoStatement->bindValue(':leNom', $nom);
        $pdoStatement->bindValue(':lePrenom', $prenom);
        $pdoStatement->bindValue(':dateConsentement', $dateConsentement);
        return $pdoStatement->execute();
    }
    
    public function tailleChampsMail() {
        $pdoStatement = PdoGsb::$monPdo->prepare("SELECT CHARACTER_MAXIMUM_LENGTH 
                                                   FROM INFORMATION_SCHEMA.COLUMNS 
                                                   WHERE table_name = 'medecin' AND COLUMN_NAME = 'mail'");
        $execution = $pdoStatement->execute();
        $leResultat = $pdoStatement->fetch();
        return $leResultat[0];
    }
    
    

    /**
     * Vérifie si l'email existe déjà dans la base de données.
     * @param string $email
     * @return bool
     */
    public function testMail($email) {
        $pdo = PdoGsb::$monPdo;
        $pdoStatement = $pdo->prepare("SELECT count(*) as nbMail FROM medecin WHERE mail = :leMail");
        $pdoStatement->bindValue(':leMail', $email);
        $pdoStatement->execute();
        $resultatRequete = $pdoStatement->fetch();
        return $resultatRequete['nbMail'] > 0;
    }

    /**
     * Ajoute une connexion initiale dans l'historique après la création d'un compte.
     * @param string $mail
     */
    public function connexionInitiale($mail) {
        $pdo = PdoGsb::$monPdo;
        $medecin = $this->donneLeMedecinByMail($mail);
        $id = $medecin['id'];
        $this->ajouteConnexionInitiale($id);
    }    

    /**
     * Ajoute une entrée dans l'historique de connexion pour un médecin.
     * @param int $id
     * @return bool
     */
    public function ajouteConnexionInitiale($id) {
        $date = date('Y-m-d H:i:s');
        $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO historiqueconnexion (idMedecin, dateDebutLog, dateFinLog) VALUES (:leMedecin, :dateConnexion, NULL)");
        $pdoStatement->bindValue(':leMedecin', $id, PDO::PARAM_INT);
        $pdoStatement->bindValue(":dateConnexion", $date, PDO::PARAM_STR);
        $pdoStatement->execute();
        return $date;
    }
    

    /**
     * Retourne les informations d'un médecin par son ID.
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function donneinfosmedecin($id) {
        $pdo = PdoGsb::$monPdo;
        $monObjPdoStatement = $pdo->prepare("SELECT id, nom, prenom FROM medecin WHERE id= :lId");
        $monObjPdoStatement->bindValue(':lId', $id, PDO::PARAM_INT);
        if ($monObjPdoStatement->execute()) {
            return $monObjPdoStatement->fetch();
        } else {
            throw new Exception("Erreur");
        }
    }

    /**
     * Retourne les informations d'un médecin par email.
     * @param string $login
     * @return array
     * @throws Exception
     */
    public function donneLeMedecinByMail($login) {
        $pdo = PdoGsb::$monPdo;
        $monObjPdoStatement = $pdo->prepare("SELECT id, nom, prenom, mail FROM medecin WHERE mail= :login");
        $monObjPdoStatement->bindValue(':login', $login, PDO::PARAM_STR);
        if ($monObjPdoStatement->execute()) {
            return $monObjPdoStatement->fetch();
        } else {
            throw new Exception("Erreur dans la requête");
        }
    }
   
    public function donneInfosportabilite($id) {
        $pdo = PdoGsb::$monPdo;
        $monObjPdoStatement = $pdo->prepare("SELECT nom, prenom, telephone, mail, dateCreation, rpps, 
        dateConsentement, dateNaissance, dateDiplome  FROM medecin WHERE id= :lId");
        $monObjPdoStatement->bindValue(':lId', $id, PDO::PARAM_INT);
        $monObjPdoStatement->execute();
        $resultat=$monObjPdoStatement->fetch(PDO::FETCH_ASSOC);
        if ($resultat==false) {
            throw new Exception('L\' id n\'existe pas');
        }
        else {
            return $resultat;
    }
}
public function AjouterCodeVerif($id, $code) {
    $pdo = PdoGsb::$monPdo;
    $monObjetStatement = $pdo->prepare("INSERT INTO verificationCode (id, code, dateCreation) VALUES (:idPersonne, :codeVerif, NOW())");
    $monObjetStatement->bindValue(":idPersonne", $id);
    $monObjetStatement->bindValue(":codeVerif", $code);
    return $monObjetStatement->execute();
}
public function recupereCode($id) {
    $pdo = PdoGsb::$monPdo;
    $monObjetStatement = $pdo->prepare("SELECT code, dateCreation FROM verificationCode WHERE id = :idPersonne");
    $monObjetStatement->bindValue(":idPersonne", $id, PDO::PARAM_INT);
    $monObjetStatement->execute();
    return $monObjetStatement->fetch(PDO::FETCH_ASSOC);
}
} 
?>
