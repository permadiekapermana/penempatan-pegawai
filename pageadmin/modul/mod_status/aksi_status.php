<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='status' AND $act=='hapus'){
  mysql_query("DELETE FROM status WHERE id_status='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='status' AND $act=='input'){

	
	
  mysql_query("INSERT INTO status(nm_status)										  										  
						VALUES	('$_POST[nm_status]')");
												
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='status' AND $act=='update'){
  mysql_query("UPDATE status SET nm_status = '$_POST[nm_status]'
  									WHERE id_status = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
