<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GSB - extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

<body background="assets/img/laboratoire.jpg">
    <class="container">
        <h1>Vos informations</h1>
        <?php $id = $_SESSION['id']?>
        <a href=" <?php echo("./portabilite/$id.json")?>" download="InfosPortabiliter.json">Télécharger vos informations sous format json !</a>
        <?php $fichiers = "./portabilite/$id.json";
        $hash_fichiers = hash("sha256", $fichiers);
        echo("Voici l\n' empreinte numérique de votre fichier ! " . $hash_fichiers);
        ?>
    </div>
    </div>
</body>
</html>
