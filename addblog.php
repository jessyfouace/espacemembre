<?php
session_start();
require('config.php');
?>
<form class="" action="verif.php?nick=<?php echo $_SESSION['pseudo']  ?>" method="post">
  <label for="titletext">Titre:</label>
  <input id="titletext" type="text" name="title" value=""><br>
  <label for="addmss">Message:</label>
  <textarea id="addmss" name="message" rows="2" cols="47"></textarea>
  <input type="submit" name="" value="Envoyer">
</form>
