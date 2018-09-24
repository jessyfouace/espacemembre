<?php
$title = addslashes(strip_tags($_POST["title"]));
$pseudo = $_GET["nick"];
$message = addslashes(strip_tags($_POST["message"]));
// check for create billets
if ($title !== "" AND $pseudo !== "" AND $message !== "") {
  $reponse = $bdd->exec("INSERT INTO blogcommentaire (title, pseudo, message) VALUES ('$title', '$pseudo', '$message')");
  header('location: index.php');
} else {
  header('location: index.php');
}
