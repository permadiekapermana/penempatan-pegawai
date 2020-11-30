<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";
include "../../../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='analisis' AND $act=='hapus'){
  mysql_query("DELETE FROM analisis WHERE id_analisis='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='analisis' AND $act=='input'){

	$n_akhir=$_POST[n_akhir];
	$nip=$_POST[nip];
	$jml=count($_POST[n_akhir]);
	for ($i=0; $i < $jml; $i++){
	
 mysql_query("UPDATE pegawai SET n_akhir = '$n_akhir[$i]'
  									WHERE nip = '$nip[$i]'");
												
  header('location:../../media.php?module=analisis&act=rangking');}
}

// Update kategori
elseif ($module=='analisis' AND $act=='update'){
  mysql_query("UPDATE analisis SET nm_analisis = '$_POST[nm_analisis]'
  									WHERE id_analisis = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  
}

// Update kategori
elseif ($module=='analisis' AND $act=='penempatan'){
  mysql_query("UPDATE pegawai SET id_bidang = '$_GET[id_bidang]', tgl_penempatan='$tgl_sekarang', status='Y'
  									WHERE nip = '$_GET[id]'");
  header('location:../../media.php?module=analisis&act=lihatpenempatan');
  
}
?>
