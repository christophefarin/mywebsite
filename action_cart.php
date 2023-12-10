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

if ($_POST['action'] == 'add')
{
    $produit=$_POST['type_cable'];
    $diam=$_POST['diam_ext'];
    $poids=$_POST['poids'];
    $section=$_POST['section_utile'];
    $nombre=1;
}

if ($_POST['action'] == 'edit') 
{
    $nombre=$_POST['nombre'];
}

$id=$_POST['id'];
$action=$_POST['action'];

//on initialise l'objet panier :
$oPanier = new cart();

switch($action){
    case "add":
        //on ajouter un produit dans le panier
        $oPanier->addProduct($id,$produit,$diam,$poids,$section,$nombre);
        break;

    case "edit":
        //on modifie la quantité d'un produit
        $oPanier->updateQteProduct($id,$nombre);
        break;

    case "delete":
        //on retire un produit du panier
        $oPanier->removeProduct($id);
        break;
}
echo json_encode($_POST);

?>
