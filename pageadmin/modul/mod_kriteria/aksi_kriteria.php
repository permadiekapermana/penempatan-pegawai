<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];

// Hapus Kategori
if ($module=='kriteria' AND $act=='hapus'){
  mysql_query("DELETE FROM kriteria WHERE id_kriteria='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='kriteria' AND $act=='delete'){

mysql_query("DELETE FROM detail_kriteria WHERE id_detail='$_GET[id]'");
												
  header('location:../../media.php?module=kriteria&act=tambahdetail');
}
// Input kategori
elseif ($module=='kriteria' AND $act=='input'){

	
	
  mysql_query("INSERT INTO kriteria(id_kriteria,nm_kriteria)										  										  
						VALUES	('$_POST[id_kriteria]','$_POST[nm_kriteria]')");
												
  header('location:../../media.php?module='.$module);
}
// Input kategori
elseif ($module=='kriteria' AND $act=='simpan'){

	
  mysql_query("INSERT INTO detail_kriteria(id_kriteria,nama_detail,skor)										  										  
						VALUES	('$_POST[id_kriteria]','$_POST[nama_detail]','$_POST[skor]')");
												
  header('location:../../media.php?module=kriteria&act=tambahdetail');
}
elseif ($module=='kriteria' AND $act=='update2'){

  mysql_query("UPDATE detail_kriteria SET nama_detail = '$_POST[nama_detail]', skor = '$_POST[skor]'
  									WHERE id_detail = '$_POST[id]'");
												
  header('location:../../media.php?module=kriteria&act=tambahdetail');
}
// Update kategori
elseif ($module=='kriteria' AND $act=='update'){
  mysql_query("UPDATE kriteria SET nm_kriteria = '$_POST[nm_kriteria]'
  									WHERE id_kriteria = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
