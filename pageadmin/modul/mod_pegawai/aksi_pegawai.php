<?php
session_start();
error_reporting(0);
include "../../../config/koneksi.php";
include "../../../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus kategori
if ($module=='pegawai' AND $act=='hapus'){
  mysql_query("DELETE FROM pegawai WHERE nip='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input kategori
elseif ($module=='pegawai' AND $act=='input'){
	if (empty($_POST[nm_pegawai])){
		echo "<script>alert('Nama harus di isi'); window.location = '../../media.php?module=pegawai&act=tambahpegawai'</script>";
		
	}
	else 
	{
$data = explode("-" , $_POST[tgl_lahir]);
$usia=$thn_sekarang - $data[0];

if ( $usia < 20 )
{
	$id_usia="1";
}
elseif ( $usia >= 21 and $usia < 30)
{
	$id_usia="2";
}	
elseif ( $usia >= 31 and $usia < 40)
{
	$id_usia="3";
}
elseif ( $usia >= 41 and $usia < 50)
{
	$id_usia="4";
}
else
{

$id_usia="5";

}	
  mysql_query("INSERT INTO pegawai(nip,
								  nm_pegawai,
								  jen_kel,
								  tempat_lahir,
								  tgl_lahir,
								  usia_skrg,
								  alamat,
								  id_pendidikan,
								  id_riwayat,
								  id_usia,
								  id_jurusan,
								  id_masa,
								  tgl_update)										  										  
						VALUES	('$_POST[nip]',
						'$_POST[nm_pegawai]',
						'$_POST[jen_kel]',
						'$_POST[tempat_lahir]',
						'$_POST[tgl_lahir]',
						'$usia',
						'$_POST[alamat]',
						'$_POST[id_pendidikan]',
						'$_POST[id_riwayat]',
						'$id_usia',
						'$_POST[id_jurusan]',
						'$_POST[id_masa]',
						'$tgl_sekarang')");
												
  header('location:../../media.php?module='.$module);
	}
}

// Update kategori
elseif ($module=='pegawai' AND $act=='update'){
	$data = explode("-" , $_POST[tgl_lahir]);
$usia=$thn_sekarang - $data[0];

if ( $usia < 20 )
{
	$id_usia="1";
}
elseif ( $usia >= 21 and $usia <  30)
{
	$id_usia="2";
}	
elseif ( $usia >= 31 and $usia <  40)
{
	$id_usia="3";
}
elseif ( $usia >= 41 and $usia <  50)
{
	$id_usia="4";
}
else
{

$id_usia="5";

}	
  mysql_query("UPDATE pegawai SET
								  nm_pegawai = '$_POST[nm_pegawai]',
								  jen_kel = '$_POST[jen_kel]',
								  tempat_lahir = '$_POST[tempat_lahir]',
								  tgl_lahir = '$_POST[tgl_lahir]',
								  usia_skrg='$usia',
								  alamat = '$_POST[alamat]',
								  id_pendidikan = '$_POST[id_pendidikan]',
								  id_riwayat = '$_POST[id_riwayat]',
								  id_usia = '$id_usia',
								  id_jurusan = '$_POST[id_jurusan]',
								  id_masa = '$_POST[id_masa]'
  								WHERE nip = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>