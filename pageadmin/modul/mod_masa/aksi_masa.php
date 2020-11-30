<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='masa' AND $act=='hapus'){
  mysql_query("DELETE FROM masa WHERE id_masa='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='masa' AND $act=='input'){

	
	
  mysql_query("INSERT INTO masa(id_masa, nm_masa)										  										  
						VALUES	('$_POST[id_masa]','$_POST[nm_masa]')");
												
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='masa' AND $act=='update'){
  mysql_query("UPDATE masa SET nm_masa = '$_POST[nm_masa]'
  									WHERE id_masa = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
