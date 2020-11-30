<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='jurusan' AND $act=='hapus'){
  mysql_query("DELETE FROM jurusan WHERE id_jurusan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='jurusan' AND $act=='input'){

	
	
  mysql_query("INSERT INTO jurusan(id_jurusan,nm_jurusan)										  										  
						VALUES	('$_POST[id_jurusan]','$_POST[nm_jurusan]')");
												
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='jurusan' AND $act=='update'){
  mysql_query("UPDATE jurusan SET nm_jurusan = '$_POST[nm_jurusan]'
  									WHERE id_jurusan = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
