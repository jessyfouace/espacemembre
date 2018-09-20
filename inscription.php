<?php
//include header page//
include 'header.php';
//connenction bdd//
require('config.php');
?>

  <form action="inscription.php" method="post">
    <label for="pseudo">Pseudonyme: </label><input id="pseudo" type="text" name="pseudo" required><br>
    <label for="mdp">Mot de passe: </label><input id="mdp" type="password" name="mdp" required><br>
    <label for="mail">Adresse mail : </label><input id="mail" type="email" name="mail" required><br>
    <input type="submit" value="S'inscrire">
  </form>
  <?php
    if (!empty($_POST['pseudo']) AND !empty($_POST['mdp']) AND !empty($_POST['mail'])) {
      if (preg_match("#[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail'])) {
        if (preg_match("#[a-z0-9._-]#", $_POST['pseudo'])) {
          if (preg_match("#[a-z0-9._-]#", $_POST['mdp'])) {
            $create = $bdd->prepare("INSERT INTO newacc (user_name, user_mail, user_password, verif_connect) VALUES (:name, :mail, :password, :connect)");
            $create->execute(array(
              'name' => $_POST['pseudo'],
              'mail' => $_POST['mail'],
              'password' => password_hash($_POST['mdp'], PASSWORD_DEFAULT),
              'connect' => 1
            ));
            $lastid = $bdd->lastInsertId();
              $create = $bdd->query('SELECT * FROM newacc WHERE id=' . $lastid . '');
              $create = $create->fetchAll();
              foreach ($create as $key => $value) {
                $_SESSION['pseudo'] = $value['user_name'];
                $_SESSION['mdp'] = password_verify($_POST['mdp'], $value['user_password']);
                $_SESSION['id'] = $value['id'];
              }
            echo "<br>Inscription Réussis.";
            header('Refresh: 2; URL=connexion.php');
          }
          else {
            $_SESSION['isConnect'] = 1;
            echo "Entrez un bon mot de passe";
          }
        }
        else {
            $_SESSION['isConnect'] = 1;
            echo "Entrez un bon pseudo";
        }
      } else {
        $_SESSION['isConnect'] = 1;
        echo "Entrez une bonne adresse e-mail";
      }
    } else {
      $_SESSION['isConnect'] = 1;
      echo "<p>Déjà inscrit ? <a style='color: blue;' href='connexion.php'>Connectez vous !</a>";
    }
  ?>

    <?php
    //including footer page//
      include 'footer.html';
    ?>
