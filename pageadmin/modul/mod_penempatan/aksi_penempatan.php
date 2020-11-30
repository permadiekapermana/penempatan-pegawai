<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus kategori
if ($module=='penempatan' AND $act=='hapus'){
  mysql_query("DELETE FROM penempatan WHERE id_penempatan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='penempatan' AND $act=='input2'){

	
	
  mysql_query("INSERT INTO penempatan(id_bidang, 
									  id_pendidikan,
									  id_riwayat,
									  id_usia,	
									  id_jurusan,
									  id_masa)								  										  
						VALUES	('$_POST[id_bidang]',
						'$_POST[id_pendidikan]',
						'$_POST[id_riwayat]',
						'$_POST[id_usia]',
						'$_POST[id_jurusan]',
						'$_POST[id_masa]')");
												
  header('location:../../media.php?module='.$module);
}

// Update kategori
elseif ($module=='penempatan' AND $act=='update'){
  mysql_query("UPDATE penempatan SET id_bidang = '$_POST[id_bidang]',
									  id_pendidikan = '$_POST[id_pendidikan]',
									  id_riwayat = '$_POST[id_riwayat]',
									  id_usia = '$_POST[id_usia]',
									  id_jurusan = '$_POST[id_jurusan]',
									  id_masa = '$_POST[id_masa]'									 
  									WHERE id_penempatan = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
