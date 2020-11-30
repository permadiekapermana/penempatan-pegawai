<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='ketentuan' AND $act=='hapus'){
  mysql_query("DELETE FROM ketentuan WHERE id_ketentuan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='ketentuan' AND $act=='input'){

	
	
  mysql_query("INSERT INTO ketentuan(selisih, nilai)										  										  
						VALUES	('$_POST[selisih]','$_POST[nilai]')");
												
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='ketentuan' AND $act=='update'){
  mysql_query("UPDATE ketentuan SET selisih = '$_POST[selisih]',nilai = '$_POST[nilai]'
  									WHERE id_ketentuan = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
