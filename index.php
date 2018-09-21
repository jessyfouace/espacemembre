<?php
//include header page//
include 'header.php';

?>
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
        // if it's rayteur connected(admin) he can create billets
        if ($_SESSION['id'] == "242") {
          echo '<form class="col-12 text-center pb-2 pt-2" action="addblog.php" method="post">
               <input type="submit" name="addblog" value="Ajouter page blog">
               </form>';
        }
        // Select the blog
        $reponse = $bdd->query('SELECT * FROM blogcommentaire ORDER BY id DESC LIMIT 5');
        // see all blog with the foreach (don't need to fetch because only 1 with this id)
        echo '<div class="col-12 col-md-6 mx-auto">';
        foreach ($reponse as $key => $value) {
          echo "<a class='col-6 mx-auto' href='viewcom.php?blog=" . $value['id'] . "'>
          <div class='colorbillet col-12 mx-auto blogcreate mt-2'>
          <div class='col-12 titlecom'>
          <p class='namebillettitle'>Titre: " . $value['title'] . "</p>
          </div>
          <div class='col-12 row'>
          <div class='col-12 name m-0'>
          <p>Message: <br>" . $value['message'] . "</p>
          </div>
          <div class='col-12 pl-4 pt-2'>
          <p class='namebilletpseudo'>Écris par: " . $value['pseudo'] . "</p>
          </div>
          </div>
          </div></a>";
        }
        echo '</div>';
      }
    }
    else {
      echo "<div class='w-100 text-center' style='margin-top: 20%'><p>Connectez vous pour avoir accès au site !</p></div>";
    }


    ?>
    <?php
      include 'footer.html';
    ?>
