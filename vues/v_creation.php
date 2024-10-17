<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GSB -extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
</head>

<body background="assets/img/laboratoire.jpg">
    <div class="page-content container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-wrapper">
                    <div class="box">
                        <div class="content-wrap">
                            <legend>Je suis médecin, je souhaite créer un compte</legend>
                            <form method="post" action="index.php?uc=creation&action=valideCreation">
                                <input name="login" class="form-control" type="email" placeholder="mail"/>
                                <input name="mdp" class="form-control" type="password" placeholder="password"/>
                                <input name="prenom" class="form-control" type="text" placeholder="prénom"/>
                                <input name="nom" class="form-control" type="text" placeholder="nom"/>
                                <input type="checkbox" style="transform: scale(1.60);" name="valider">
                                <label>
                                    J'atteste avoir lu et accepte notre <a href='vues/v_politiqueprotectiondonnees.html'>politique de protection des données</a>
                                </label>
                                <input type="hidden" name="dateConsentement" value="<?php echo date('Y-m-d'); ?>">
                                <br>
                                <input type="submit" class="btn btn-primary signup" value="Créer"/>
                            </form>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
