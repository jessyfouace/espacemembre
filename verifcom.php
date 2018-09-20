<?php include('config.php'); ?>

<?php
$nickname = $_GET["pseudo"];
$msg = addslashes(strip_tags($_POST["commentary"]));
$idblog = $_GET['blog'];
  if ($nickname !== "" AND $msg !== "") {
    $resultcom = $bdd->exec("INSERT INTO commentaire (nicknamecom, messagecom, id_blog) VALUES ('$nickname', '$msg', '$idblog')");
    header('location: viewcom.php?blog=' . $idblog . '');
  } else {
    header('location: viewcom.php?blog=' . $idblog . '');
  }
?>
