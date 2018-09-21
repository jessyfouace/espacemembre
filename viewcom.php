<?php
//include header page//
include 'header.php';
// prepare select for the blog page (it's here for title of page)
$blognumber = $_GET["blog"];
$resultblog = $bdd->prepare('SELECT * FROM blogcommentaire WHERE id=?');
// execute array for WHERE did same of id and the number of page blog
$resultblog->execute(array($_GET['blog']));

// Just security
if ($resultblog->rowCount() ==1) {
  $resultblog = $resultblog->fetch();
  $title = $resultblog['title'];
  $pseudo = $resultblog['pseudo'];
  $message = $resultblog['message'];
}
?>
    <?php
    if (!empty($_SESSION['pseudo'])) {
      echo "<div class='colorbillet col-12 mx-auto blogcreate mt-2'>
      <div class='col-12 titlecom'>
      <p class='namebillettitle'>Titre: " . $title . "</p>
      </div>
      <div class='col-12 row'>
      <div class='col-12 name m-0'>
      <p>Message: <br>" . $message . "</p>
      </div>
      <div class='col-12 pl-4 pt-2'>
      <p class='namebilletpseudo'>Écris par: " . $pseudo . "</p>
      </div>
      </div>
      </div>";


     echo "<p class='w-100 text-center pt-5'>Zone commentaire:</p>";
     $resultcom = $bdd->prepare('SELECT * FROM commentaire WHERE id_blog=? ORDER BY id DESC LIMIT 5');
     $resultcom->execute(array($_GET['blog']));

     // fetchall for take ALL the table
     $resultcom = $resultcom->fetchAll();

     // foreach for see all commentary
     foreach ($resultcom as $key => $value) {
      echo "<div class='col-6 mx-auto blogcreate mt-2'>
        <div class='col-12 row'>
          <div class='col-12 name m-0'>
            <h2>" . $value['nicknamecom'] . "</h2>
          </div>
          <div class='col-12 pl-4 pt-2'>
            <p>" . $value['messagecom'] . "</p>
          </div>
        </div>
      </div>";
    }
     // add some commentary
      echo '<form class="col-6 mx-auto m-0 p-0 pt-2 text-right" action="verifcom.php?blog=' . $_GET["blog"] . '&amp;pseudo=' . $_SESSION["pseudo"] . '" method="post">
      <textarea class="col-12" name="commentary" rows="4" cols="80"></textarea>
      <input type="submit" name="" value="Envoyer">
      </form>';
    }
    else {
      echo "<div class='w-100 text-center' style='margin-top: 20%'><p>Connectez vous pour avoir accès au site !</p></div>";
    }


    ?>
    <?php
      include 'footer.html';
    ?>
