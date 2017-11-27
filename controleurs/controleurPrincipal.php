<?php
// appel de tous les fichiers nécessaire
require_once 'fonctions/menu.php';
require_once 'fonctions/formulaire.php';
require_once 'fonctions/dispatcher.php';
require_once 'modeles/dto/adherent.php';
require_once 'modeles/dao/dao.php';
require_once 'fonctions/fonctions.php';



// verifie si il y a deja un menu principal et lui affecte la valeur selectionné
if (isset($_GET['bioRelaiMP'])){
    $_SESSION['bioRelaiMP']= $_GET['bioRelaiMP'];
}
// sinon affecte au menu principal la valeur par defaut
else{
    if(!isset($_SESSION['bioRelaiMP'])){
        $_SESSION['bioRelaiMP']="accueil";
    }
}

// *****verifie si le login et le mdp inséré correspond a un abonné existant
// dans la bas de donnee, si il existe, il se connecte et est redirigé a l'accueil
// sinon son mdp ou login est incorrect et reste sur la page******
$messageErreurConnexion= '';
if (isset($_POST['login'],$_POST['mdp'])){
    $unAdherent =new adherent($_POST['login']);
    $_SESSION['identification']=adherentDAO::verification($unAdherent);

    if($_SESSION['identification']){
        $_SESSION['bioRelaiMP']='accueil';
    }
    else{
        $unProducteur =new producteur($_POST['login']);
        $_SESSION['identificationProd']=producteurDAO::verification($unAdherent);
        
        if($_SESSION['identificationProd']){
            $_SESSION['bioRelaiMP']='accueil';
        }
        else{
        $messageErreurConnexion='Login ou mot de passe incorrect';
        }
    }
}

//************ cree un nouveau menu principal***********
$bioRelaiMP = new Menu("menuPrincipal");


$bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("accueil", "Accueil"));

//********* verifie si l'abonne est connecté
// il affiche des onglets supplémentaire concernant l'abonne**********
if (isset($_SESSION['identification'])){
    $bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("MonCompteAdherent", "Mon compte"));
    $bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("deconnexion", "Se deconnecter"));
}
else {
    if (isset($_SESSION['identificationProd'])){
        $bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("MonCompteProducteur", "Mon compte"));
        $bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("deconnexion", "Se deconnecter"));
    }
    else{
        $bioRelaiMP->ajouterComposant($bioRelaiMP->creerItemLien("connexion", "Se connecter"));
    }
  
}
//*********** crée le menu principal
$menuPrincipal = $bioRelaiMP->creerMenu($_SESSION['bioRelaiMP'],'bioRelaiMP');

include_once dispatcher::dispatch($_SESSION['bioRelaiMP']);

?>
