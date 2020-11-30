<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='usia' AND $act=='hapus'){
  mysql_query("DELETE FROM usia WHERE id_usia='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='usia' AND $act=='input'){

	
	
  mysql_query("INSERT INTO usia(id_usia, nm_usia)										  										  
						VALUES	('$_POST[id_usia]','$_POST[nm_usia]')");
												
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='usia' AND $act=='update'){
  mysql_query("UPDATE usia SET nm_usia = '$_POST[nm_usia]'
  									WHERE id_usia = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
