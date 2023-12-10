<?php
//fichier fetch_cart.php
//https://datatables.net/manual/server-side pour plus d'explications

//affichage des erreurs PHP ( A mettre au début de tes scripts PHP )
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//démarrage une session si pas déjà démarrée
if (session_status()==1) { //_DISABLED = 0, _NONE = 1, _ACTIVE = 2
    session_start();
}
//on inclus la class qui permet de gérer le panier
require_once "class_cart.php";

//on initialise l'objet panier :
$oPanier = new cart();

//reset de l'affichage du panier
$reseTabcart=intval($_POST['draw']);

//on affiche le nombre de produits différents dans le panier
$nbIdProducts = $oPanier->getNbIdProductsInCart();

//on affiche le contenu du panier 
$contenu_panier = $oPanier->getList();

if(!empty($nbIdProducts))
{
foreach($contenu_panier as $row)
{
 $sub_array = array();
 $sub_array[] = $row['id'];
 $sub_array[] = $row['produit'];
 $sub_array[] = $row['diametre'];
 $sub_array[] = $row['poids'];
 $sub_array[] = $row['section'];
 $sub_array[] = $row['nombre'];
 $data[] = $sub_array;
}
}
else {$data = array();}

//retourne les données dans DataTables
$output = array(
 'draw'   => $reseTabcart,
 'recordsTotal' => $nbIdProducts,
 'recordsFiltered' => $nbIdProducts,
 'data'   => $data
);

echo json_encode($output);
?>
