<?php
require_once('connect.php');
if(!empty($_POST["type_cdc"])) {
$reshtr=$db->Select("SELECT DISTINCT(`hauteur`) FROM `catalogue_cdc` WHERE `type_cdc` = '" . $_POST["type_cdc"] . "'");
?>
	<option value="">Sélectionnez la hauteur</option>
<?php
	foreach($reshtr as $hauteurs) {
?>
	<option value="<?php echo $hauteurs["hauteur"]; ?>"><?php echo $hauteurs["hauteur"]; ?></option>
<?php
	}
	}
?>