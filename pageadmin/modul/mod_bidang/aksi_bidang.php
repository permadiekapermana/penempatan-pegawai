<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus bidang
if ($module=='bidang' AND $act=='hapus'){
  mysql_query("DELETE FROM bidang WHERE id_bidang='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input bidang
elseif ($module=='bidang' AND $act=='input'){

	
	
  mysql_query("INSERT INTO bidang(id_bidang,nm_bidang)										  										  
						VALUES	('$_POST[id_bidang]','$_POST[nm_bidang]')");
												
  header('location:../../media.php?module='.$module);
}

// Update bidang
elseif ($module=='bidang' AND $act=='update'){
  mysql_query("UPDATE bidang SET nm_bidang = '$_POST[nm_bidang]'
  									WHERE id_bidang = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
