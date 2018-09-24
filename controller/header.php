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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->
  <link rel="stylesheet" href="../public/css/normalize.css">
  <link rel="stylesheet" href="../public/css/bootstrap.css">
  <link rel="stylesheet" href="../public/css/main.css">
</head>
<body>

    <header class="row m-0" style="background-color: orange">
      <div class="col-12 w-100 m-0 row text-center">
        <div class="d-none d-md-block col-md-2 pt-2 pb-2">
            <a href="index.php"><p>LOGO</p></a>
        </div>
        <div class="col-10 col-md-8 pt-2 pb-2">
            <a href="index.php"><p>Nom du site</p></a>
        </div>
        <div style="position: absolute; right: 40px; top: 5px;">
            <?php
            // Check if pseudo is no't empty
            if (!empty($_SESSION['pseudo'])) {
              // check bdd and take the user information
            $create = $bdd->prepare('SELECT * FROM newacc WHERE id = :idtake');
            $create->execute(array(
              'idtake' => $_SESSION['id']
            ));
            $create = $create->fetchAll();
            // Foreach for check if the user is connected or no
            foreach ($create as $key => $value) {
              if ($value['verif_connect'] == 0) {
                echo "<i id='profil' class='fas fa-user-alt fa-2x'></i>";
                echo "<div id='viewprofil' style='position: absolute; background-color: white; margin-top: 15px;right: -35px; z-index: 5; border: 1px solid #d5d5d5; display: none;' class='text-center'>
                  <a href='profil.php'><i class='w-100 p-2 fas fa-user-alt'><br> Profil</i></a>
                  <a href='deconnexion.php'><i class='w-100 p-2 fas fa-lock-open'> Disconnect</i></a>
                </div>";
              }
            }
            // if the user is no't connected make se connecter
          }else {
                echo "<a href='inscription.php'>S'inscrire / Connexion</a>";
            }
           ?>
        </div>
      </div>

    </header>
