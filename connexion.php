<?php
//include header page//
include 'header.php';
//connenction bdd//
require('config.php');
// Just the html
require('view/connexionView.php');
// Connect php base for connexion;
require('model/connexionModel.php');
//including footer page//
include 'footer.html';
?>
