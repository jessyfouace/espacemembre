<?php session_start();?>
<?php require('config.php') ?>
<!doctype html>
  <html lang="FR">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Espace membre</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/main.css">
</head>
<body>

    <header class="row m-0" style="background-color: orange">
      <div class="col-12 w-100 m-0 row text-center">
        <div class="col-2 pt-2 pb-2">
            <p>LOGO</p>
        </div>
        <div class="col-8 pt-2 pb-2">
            <p>J'ai pas d'inspi pour le nom du site</p>
        </div>
        <div class="col-2 pt-2 pb-2">
            <?php
            if (!empty($_SESSION['pseudo'])) {
            $create = $bdd->prepare('SELECT * FROM newacc WHERE id = :idtake');
            $create->execute(array(
              'idtake' => $_SESSION['id']
            ));
            $create = $create->fetchAll();
            foreach ($create as $key => $value) {
              if ($value['verif_connect'] == 0) {
                echo "<a href='deconnexion.php'>Se Déconnecter</a>";
              }
            }
          }else {
                echo "<a href='inscription.php'>Se connecter</a>";
            }
           ?>
        </div>
      </div>
    </header>
