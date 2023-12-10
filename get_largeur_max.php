<?php
require_once('connect.php');
if(!empty($_POST["hauteur"])) {
$res=$db->Select("SELECT (`largeur`) FROM `catalogue_cdc` WHERE `type_cdc` = '" . $_POST["type_cdc"] . "' AND `hauteur`='" . $_POST["hauteur"] . "'");
// $count=count($res);
$reslargeurs=array_column($res,"largeur");
?>
	<option value="<?php echo max($reslargeurs); ?>"><?php echo max($reslargeurs); ?></option>
<?php
	foreach($res as $largeurs) {
?>
	<option value="<?php echo $largeurs["largeur"]; ?>"><?php echo $largeurs["largeur"]; ?></option>
<?php
	}
}
?>
