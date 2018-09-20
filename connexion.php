<?php
//include header page//
include 'header.php';
//connenction bdd//
require('config.php');
// is_bool($_SESSION['isConnect']);
?>

  <form action="connexion.php" method="post">
    <label for="pseudo">Pseudonyme: </label><input id="pseudo" type="text" name="pseudo" required><br>
    <label for="mdp">Mot de passe: </label><input id="mdp" type="password" name="mdp" required><br>
    <input type="submit" value="Se connecter">
  </form>
  <?php
    if (!empty($_POST['pseudo']) AND !empty($_POST['mdp'])) {
        if (preg_match("#[a-z0-9._-]#", $_POST['pseudo'])) {
          if (preg_match("#[a-z0-9._-]#", $_POST['mdp'])) {
            $create = $bdd->query('SELECT * FROM newacc');
            $create = $create->fetchAll();
            foreach ($create as $key => $value) {
              if ($_POST['pseudo'] == $value['user_name'] AND password_verify($_POST['mdp'], $value['user_password'])) {
                $_SESSION['pseudo'] = $value['user_name'];
                $_SESSION['mdp'] = password_verify($_POST['mdp'], $value['user_password']);
                $_SESSION['id'] = $value['id'];
                $create = $bdd->prepare('UPDATE newacc SET verif_connect=0 WHERE id=:takeid');
                $create->execute  (array(
                  'takeid' => $value['id']
                ));
                echo "Connection réussis";
                header('Refresh: 2; URL=index.php');
              }
            }
          } else {
            echo 'Pseudo ou mot de passe faux';
          }
          }
          else {
            $_SESSION['isConnect'] = 1;
            echo "Pseudo ou mot de passe faux";
          }
        }
        else {
            $_SESSION['isConnect'] = 1;
            echo "<p>Pas encore inscrit ? <a style='color: blue;' href='inscription.php'>Inscrivez vous !</a>";
        }
  ?>

    <?php
    //including footer page//
      include 'footer.html';
    ?>
