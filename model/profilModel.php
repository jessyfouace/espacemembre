<?php
// Check user is connected
if (!empty($_SESSION['pseudo'])) {
  $create = $bdd->prepare('SELECT * FROM newacc WHERE id = :idtake');
  $create->execute(array(
    'idtake' => $_SESSION['id']
  ));
  $create = $create->fetch();
  // if user is connected check the user id and check is he's connected
  if ($create['verif_connect'] == 0) {
    echo "<form action='profil.php' method='post'>
      <label for='newname'>Nouveau pseudo: </label>
      <input id='newname' type='text' name='newpseudo'><br>
      <label for='newpass'>Ancien MDP: </label>
      <input id='lesspass' type='password' name='lesspass'><br>
      <label for='lesspass2'>Répetez l'ancien mdp: </label>
      <input id='lesspass2' type='password' name='lesspass2'><br>
      <label for='newpass'>Nouveau MDP: </label>
      <input id='newpass' type='password' name='newpass'><br>
      <input type='submit' value='Valider'>
    </form>";
    if (!empty($_POST['newpseudo'])) {
      if (preg_match("#[a-z0-9._-]#", $_POST['newpseudo'])) {
        $checkpseudo = $bdd->prepare('SELECT * FROM newacc WHERE user_name=:checkpseudo');
        $checkpseudo->execute(array(
          'checkpseudo' => $_POST['newpseudo']
        ));
        $checkpseudo = $checkpseudo->fetchAll();
        if ($checkpseudo) {
          echo "Pseudo déjà utiliser";
          header('location=profil.php');
        } else {
        $idtake = $_SESSION['id'];
        $create = $bdd->prepare('UPDATE newacc SET user_name=:newname WHERE id=' . $idtake . '');
        $create->execute(array(
          'newname' => $_POST['newpseudo']
        ));
        echo "Votre pseudo est maintenant: " . $_POST['newpseudo'];
        $_SESSION['pseudo'] = $_POST['newpseudo'];
      }
      } else {
        echo "Pseudo incorrect";
      }
    }
    if (!empty($_POST['lesspass']) AND !empty($_POST['lesspass2']) AND !empty($_POST['newpass'])) {
      if ($_POST['lesspass'] == $_POST['lesspass2']) {
        if ($_POST['lesspass'] == $_SESSION['mdp']) {
            if (preg_match("#[a-z0-9._-]#", $_POST['newpass'])) {
            $idtake = $_SESSION['id'];
            $create = $bdd->prepare('UPDATE newacc SET user_password=:newpass WHERE id=' . $idtake . '');
            $create->execute(array(
              'newpass' => password_hash($_POST['newpass'], PASSWORD_DEFAULT)
            ));
            }
            $_SESSION['mdp'] = password_verify($_POST['mdp'], $value['user_password']);
            header('location: deconnexion.php');
        }
        else {
          echo "Les anciens mot de passe sont faux.";
        }
      } else {
        echo "Les anciens mot de passe ne correspondes pas entre eux.";
      }
    }
  }
}else {
    echo "<div class='w-100 text-center' style='margin-top: 20%'><p>Connectez vous pour avoir accès au site !</p></div>";
  }
