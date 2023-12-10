<?php
//Affichage des erreurs PHP ( A mettre au début de tes scripts PHP )
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// Démarrage une session si pas déjà démarrée
if (session_status()==1) { //_DISABLED = 0, _NONE = 1, _ACTIVE = 2
    session_start();
}
//on inclus la class qui permet de gérer le panier
require_once "class_cart.php";

//on initialise l'objet panier :
$oPanier = new cart();

//on ajouter un produit dans le panier
$calculs = $oPanier->getSumsInCart();

echo json_encode($calculs);

?>
