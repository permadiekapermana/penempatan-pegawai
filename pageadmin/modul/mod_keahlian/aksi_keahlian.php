<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='keahlian' AND $act=='hapus'){
  mysql_query("DELETE FROM keahlian WHERE id_keahlian='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='keahlian' AND $act=='input'){

	
	
  mysql_query("INSERT INTO keahlian(nm_keahlian)										  										  
						VALUES	('$_POST[nm_keahlian]')");
												
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='keahlian' AND $act=='update'){
  mysql_query("UPDATE keahlian SET nm_keahlian = '$_POST[nm_keahlian]'
  									WHERE id_keahlian = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
