<?php
$menuAdherent = new Menu("menuSecondaire");



$menuSecondaire = $bioRelaiAdherent->creerMenu($_SESSION['bioRelaiMP'],'bioRelaiAdherent');

include_once 'vues/MonCompteAdherent.php';
?>