<?php
include('../../mdp/mdp.php');
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=tpmembre;charset=utf8', 'root', $mdp);
}

catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
?>
