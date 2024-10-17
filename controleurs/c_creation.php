<?php

if (!isset($_GET['action'])) {
    $_GET['action'] = 'demandeCreation';
}
$action = $_GET['action'];

switch ($action) {
    case 'demandeCreation': {
        include("vues/v_creation.php");
        break;
    }

    case 'valideCreation': {
        // Vérification si la case à cocher est cochée
        if (!isset($_POST['valider'])) {
            echo "Vous devez accepter la politique de protection des données pour créer votre compte.<br/>";
            include("vues/v_creation.php");
            break;
        }

        // Récupération et protection contre XSS des données
        $leLogin = htmlspecialchars($_POST['login']);
        $lePassword = htmlspecialchars($_POST['mdp']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $dateConsentement = date('Y-m-d H:i:s'); // Date actuelle

        // Initialisation des flags de validation
        $loginOk = true;
        $passwordOk = true;
        $rempli = true;

        // Vérification du login (email)
        if (empty($leLogin)) {
            echo 'Le login n\'a pas été saisi.<br/>';
            $rempli = false;
        } elseif (!filter_var($leLogin, FILTER_VALIDATE_EMAIL)) {
            echo 'Le mail n\'a pas un format correct.<br/>';
            $loginOk = false;
        } elseif ($pdo->testMail($leLogin)) {
            echo "Ce login existe déjà, veuillez en choisir un autre.<br/>";
            $loginOk = false;
        }

        // Vérification du mot de passe
        $patternPassword = '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{12,}#';
        if (empty($lePassword)) {
            echo 'Le mot de passe n\'a pas été saisi.<br/>';
            $rempli = false;
        } elseif (!preg_match($patternPassword, $lePassword)) {
            echo 'Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule, un chiffre, et un caractère spécial.<br/>';
            $passwordOk = false;
        }

        // Si toutes les conditions sont remplies, création du compte
        if ($rempli && $loginOk && $passwordOk) {
            echo 'Tout est OK, nous allons pouvoir créer votre compte...<br/>';
            $executionOK = $pdo->creeMedecin($leLogin, $lePassword, $nom, $prenom, $dateConsentement);

            if ($executionOK) {
                echo "C'est bon, votre compte a bien été créé !<br/>";
                $pdo->connexionInitiale($leLogin); // Connexion automatique après création
            } else {
                echo "Une erreur est survenue lors de la création du compte. Veuillez réessayer.<br/>";
            }
        } else {
            include("vues/v_creation.php");
        }

        break;
    }

    default: {
        include("vues/v_connexion.php");
        break;
    }
}
?>
