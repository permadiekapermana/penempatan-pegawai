<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='riwayat' AND $act=='hapus'){
  mysql_query("DELETE FROM pengalaman WHERE id_riwayat='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='riwayat' AND $act=='input'){

	
	
  mysql_query("INSERT INTO pengalaman(id_riwayat, nm_riwayat)										  										  
						VALUES	('$_POST[id_riwayat]','$_POST[nm_riwayat]')");
												
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='riwayat' AND $act=='update'){
  mysql_query("UPDATE pengalaman SET nm_riwayat = '$_POST[nm_riwayat]'
  									WHERE id_riwayat = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
