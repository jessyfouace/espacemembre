<?php
//include header page//
include 'header.php';

?>
    <?php
    if (!empty($_SESSION['pseudo'])) {
      $create = $bdd->prepare('SELECT * FROM newacc WHERE id = :idtake');
      $create->execute(array(
        'idtake' => $_SESSION['id']
      ));
      $create = $create->fetch();
      if ($create['verif_connect'] == 0) {
        if ($_SESSION['pseudo'] == "Rayteur" AND $_SESSION['mdp'] == "test") {
          echo '<form class="col-12 text-center pb-2 pt-2" action="addblog.php" method="post">
               <input type="submit" name="addblog" value="Ajouter page blog">
               </form>';
        }
        // Select the blog
        $reponse = $bdd->query('SELECT * FROM blogcommentaire ORDER BY id DESC LIMIT 5');
        // see all blog with the foreach (don't need to fetch because only 1 with this id)
        echo '<div class="col-6 mx-auto">';
        foreach ($reponse as $key => $value) {
          echo "<a class='col-6 mx-auto' href='viewcom.php?blog=" . $value['id'] . "'>
          <div class='col-12 mx-auto blogcreate mt-2'>
          <div class='col-12 titlecom'>
          <h1>" . $value['title'] . "</h1>
          </div>
          <div class='col-12 row'>
          <div class='col-12 name m-0'>
          <h2>" . $value['pseudo'] . "</h2>
          </div>
          <div class='col-12 pl-4 pt-2'>
          <p>" . $value['message'] . "</p>
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
