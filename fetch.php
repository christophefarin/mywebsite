<?php
//fichier fetch.php
//https://datatables.net/manual/server-side pour plus d'explications sur le plugin datatables
//https://api.jquery.com/jquery.ajax/ documentation pour effectuer une requête HTTP asynchrone (Ajax)

//on inclut la connexion à la base
require_once('connect.php');

$column = array("id", "type_cable", "diam_ext", "poids","section_utile"); //suppression "nombre"

//on écrit notre requête
$queryinit = "SELECT * FROM catalogue_cables";

//requête déterminant la pagination des données dans le tableau suivant les paramètres "length" et "start" de DataTables
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

//requêtes si valeur entrée dans le champ "Rechercher"
if(isset($_POST["search"]["value"]))
{
    $querysearch = $queryinit .=' WHERE type_cable LIKE "%'.$_POST["search"]["value"].'%" OR diam_ext LIKE "%'.$_POST["search"]["value"].'%" OR poids LIKE "%'.$_POST["search"]["value"].'%"OR section_utile LIKE "%'.$_POST["search"]["value"].'%"';
    // $query = $db->Select($querysearch);
    $number_filter_row = $db->Count($querysearch);
    $result=$db->Select($querysearch . $query1);
}

//requêtes si un tri est activé sur une colonne
if(isset($_POST["order"]))
{
    $queryorder = $queryinit .=' ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
    // $query = $db->Select($queryorder);
    $number_filter_row = $db->Count($queryorder);
    $result=$db->Select($queryorder . $query1);
}

//requêtes en défaut de recherche et de tri
else
{
    $queryelse = $queryinit .='ORDER BY id DESC ';
    // $query = $db->Select($queryelse);
    $number_filter_row = $db->Count($queryelse);
    $result=$db->Select($queryelse . $query1);
}

//récupère les données correspondant à la pagination
$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['id'];
 $sub_array[] = $row['type_cable'];
 $sub_array[] = $row['diam_ext'];
 $sub_array[] = $row['poids'];
 $sub_array[] = $row['section_utile'];
 $data[] = $sub_array;
}

//retourne les données et paramètres dans DataTables
$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => $count_all_data = $db->Count($queryinit),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data //array(array(1,"toto",1,1,1)) 
);

echo json_encode($output);

//on ferme la connexion à la base
$db->Close();

?>
