<?php
require_once('connect.php');
// if(!empty($_POST["fetch"])) {
$resinit=$db->Select("SELECT DISTINCT(`type_cdc`) FROM `catalogue_cdc`"); //requête pour première liste déroulante
?>
	<option value="">Sélectionnez le type</option>
<?php
	foreach($resinit as $types) {
?>
	<option value="<?php echo $types["type_cdc"]; ?>"><?php echo $types["type_cdc"]; ?></option>
<?php
	}
	// }
?>