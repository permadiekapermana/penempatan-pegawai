<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
	echo "
			<div class='col-md-12'>
				<div class='card'>
                    <div class='header'>
						<center><h4 class='title'><b>LAPORAN HASIL <br> REKOMENDASI PENEMPATAN PEGAWAI <br> DI BKPSDM KAB. INDRAMAYU</b><center></h4>
					</div>
						<div class='content'>
						<form action='modul/mod_laporan/cetak_pegawai.php' target='_blank' method='post'>
							<input type='date' style='width: 200px' name='dari'  class='form-control' title='Dari tanggal' />
							<input type='date' style='width: 200px' name='sampai'  class='form-control' title='Sampai tanggal' />
							<select name='id_bidang' class='form-control'>
			<option value=0 selected>- Pilih Bidang -</option>
			<option value='semua'>Semua Bidang</option>";
            $tampil=mysql_query("SELECT * FROM bidang ORDER BY nm_bidang");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_bidang]>$r[nm_bidang]</option>";
            }
    echo "						</select>
							<button class='btn btn-primary' type='submit'><i class='fa fa-print'></i> Cetak</button>
						</form>
                            <table class='table table-hover table-striped'>
                                    <thead>
                                        <th><b>No</b></th>
                                    	<th><b>NIP</b></th>
										<th><b>Nama Pegawai</b></th>
										<th><b>Pendidikan Terakhir</b></th>
										<th><b>Pengalaman Kerja</b></th>
										<th><b>Usia</b></th>
										<th><b>Jurusan Pendidikan</b></th>
										<th><b>Masa Kerja</b></th>
                                    	<th><b>Bidang</b></th>
                                    </thead>
                                    <tbody>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM pegawai, bidang where pegawai.id_bidang=bidang.id_bidang and pegawai.status='Y' ORDER BY bidang.id_bidang DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
	
	if ($r[id_pendidikan]=='1'){
		
	$pendidikan="D1-D2";	
	}
	elseif ($r[id_pendidikan]=='2'){
		
	$pendidikan="D3";	
	}
	elseif ($r[id_pendidikan]=='3'){
		
	$pendidikan="S1";	
	}
	elseif ($r[id_pendidikan]=='4'){
		
	$pendidikan="S2";	
	}
	else {
		
	$pendidikan="S3";
	}
	
	if ($r[id_riwayat]=='1'){
		
	$riwayat=" Tidak Ada";	
	}
	else {
		
	$riwayat="Ada";
	}
	
	if ($r[id_jurusan]=='1'){
		
	$jurusan="Hukum";	
	}
	elseif ($r[id_jurusan]=='2'){
		
	$jurusan="Pendidikan";	
	}
	elseif ($r[id_jurusan]=='3'){
		
	$jurusan="Teknik";	
	}
	elseif ($r[id_jurusan]=='4'){
		
	$jurusan="Pemerintahan";	
	}
	else {
		$jurusan="Ekonomi";	
	}
	
	if ($r[id_masa]=='1'){
		
	$masa="< 1 Tahun";	
	}
	elseif ($r[id_masa]=='2'){
		
	$masa="1-5 Tahun";	
	}
	elseif ($r[id_masa]=='3'){
		
	$masa="6-10 Tahun";	
	}
	else {
		$masa="> 10 Tahun";
		
	}
                                    echo " 	<tr>
                                        	<td>$no</td>
                                        	<td>$r[nip]</td>
											<td>$r[nm_pegawai]</td>
											<td>$pendidikan</td>
											<td>$riwayat</td>
											<td>$r[usia_skrg] Tahun</td>
											<td>$jurusan</td>
											<td>$masa</td>
                                        	<td>$r[nm_bidang]</td>
											</tr>";
									$no++;
	}  
                                    echo" </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
	";
	
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM pegawai"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "<div id=paging>Hal: $linkHalaman</div><br>"; 
}
?>