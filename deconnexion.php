<?php require('header.php'); ?>
<?php require('config.php') ?>
<?php
  $idtake = $_SESSION['id'];
  $create = $bdd->exec('UPDATE newacc SET verif_connect=1 WHERE id=' . $idtake . '');
  session_destroy();
  header('location: index.php');
?>
