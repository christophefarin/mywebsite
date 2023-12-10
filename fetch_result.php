<?php
//fichier fetch_result.php
//https://datatables.net/manual/server-side pour plus d'explications sur le plugin datatables
//https://api.jquery.com/jquery.ajax/ documentation pour effectuer une requête HTTP asynchrone (Ajax)

//on inclut la connexion à la base
require_once('connect.php');

$column = array("id", "type_cdc", "largeur", "hauteur", "charge_max", "poids");

//on récupère les valeurs pour notre requête
$type_cdc_forequest = $_POST['type_cdc'];
$hauteur_forequest = number_format($_POST['hauteur']);
$largeurcible_forequest = number_format($_POST['result_diam'],2,'.','');
$largeurmax_forequest = number_format($_POST['largeurmax']);
$chargecible_forequest = number_format($_POST['result_poids'],2,'.','');
$volumecible_forequest = number_format($_POST['result_section'],2,'.','');

//on écrit notre requête
$queryinit = "SELECT id, type_cdc, largeur, hauteur, charge_max, poids FROM catalogue_cdc WHERE type_cdc LIKE '$type_cdc_forequest' AND largeur >= '$largeurcible_forequest' AND largeur <= '$largeurmax_forequest' AND hauteur='$hauteur_forequest' AND charge_max>='$chargecible_forequest' AND section_max>='$volumecible_forequest'";

//requête déterminant la pagination des données dans le tableau suivant les paramètres "length" et "start" de DataTables
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$queryelse = $queryinit .=' ORDER BY id ASC ';
//$query = $db->Select($queryelse);
$number_filter_row = $db->Count($queryelse);
$result=$db->Select($queryelse . $query1);

//récupère les données correspondant à la pagination
$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['id'];
 $sub_array[] = $row['type_cdc'];
 $sub_array[] = $row['largeur'];
 $sub_array[] = $row['hauteur'];
 $sub_array[] = $row['charge_max'];
 $sub_array[] = $row['poids'];
 $data[] = $sub_array;
}

//retourne les données et paramètres dans DataTables
$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => $count_all_data = $db->Count($queryinit),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data //array(array(1,"toto",1,1,1,1)) //pour test
);

echo json_encode($output);

//on ferme la connexion à la base
$db->Close();

?>
