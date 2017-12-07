<?php
$menuAdherent = new Menu("menuSecondaire");

$menuAdherent->ajouterComposant($menuAdherent->creerItemLien("ModifierCompte", "Modifier mes infos"));
$menuAdherent->ajouterComposant($menuAdherent->creerItemLien("ConsulterFactures", "Consulter mes factures"));
$menuAdherent->ajouterComposant($menuAdherent->creerItemLien("MonPanier", "Mon panier"));

$menuSecondaire = $menuAdherent->creerMenu($_SESSION['bioRelaiMP'],'menuAdherent');

include_once 'vues/MonCompteAdherent.php';
?>