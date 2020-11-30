<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='pendidikan' AND $act=='hapus'){
  mysql_query("DELETE FROM pendidikan WHERE id_pendidikan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='pendidikan' AND $act=='input'){

	
	
  mysql_query("INSERT INTO pendidikan(id_pendidikan, nm_pendidikan)										  										  
						VALUES	('$_POST[id_pendidikan]','$_POST[nm_pendidikan]')");
												
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='pendidikan' AND $act=='update'){
  mysql_query("UPDATE pendidikan SET nm_pendidikan = '$_POST[nm_pendidikan]'
  									WHERE id_pendidikan = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
