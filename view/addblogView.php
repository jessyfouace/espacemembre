<?php
if ($_SESSION['id'] == "242") {
echo '<form class="" action="verif.php?nick=' . $_SESSION["pseudo"] . '" method="post">
  <label for="titletext">Titre:</label>
  <input id="titletext" type="text" name="title" value=""><br>
  <label for="addmss">Message:</label>
  <textarea id="addmss" name="message" rows="2" cols="47"></textarea>
  <input type="submit" name="" value="Envoyer">
</form>';
} else {
  echo 'Vous n\'êtes pas administrateur du site! Vous n\'avez pas l\'accès à poster un message';
}
