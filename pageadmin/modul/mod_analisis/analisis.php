<?php
$pel="SD.";
$y=substr($pel,0,2);
$query=mysql_query("select * from bidang where substr(kd_bidang,1,2)='$y' order by kd_bidang desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['kd_bidang'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_analisis/aksi_analisis.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
    echo "
					<div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h3 class='title'><b>ANALISIS PROFILE MATCHING</b></h3>
                            </div>
                            <div class='content'>
                                <form action='?module=analisis&act=lihatanalisis' method='post'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Bidang</label>
                                                <select name='id_bidang' class='form-control'>
            <option value=0 selected>- Pilih Bidang -</option>";
            $tampil=mysql_query("SELECT * FROM bidang ORDER BY nm_bidang");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_bidang]>$r[nm_bidang]</option>";
            }
    echo "						</select>
                                    </div>  
                                    </div>
									</div>
                                    <button type='submit' class='btn btn-info btn-fill pull-left'>Simpan</button>
                                    <div class='clearfix'></div>
                                </form>
                            </div>
                        </div>
                    </div>
";
  break;
  
  case "lihatanalisis":
  session_start();
    $edit=mysql_query("SELECT * FROM penempatan, bidang  WHERE penempatan.id_bidang=bidang.id_bidang and penempatan.id_bidang='$_POST[id_bidang]'");
    $r2=mysql_fetch_array($edit);
	
			$_SESSION[id_bidang] = $r2[id_bidang];
				echo "
					<div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                               <center><h4 class='title'><b>REKOMENDASI PENEMPATAN PEGAWAI PADA BIDANG <br> $r2[nm_bidang]</b></h4></center>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th><b>No</b></th>
										<th><b>NIP</b></th>
                                    	<th><b>Nama Pegawai</b></th>										
										<th><b>Pendidikan</b></th>										
										<th><b>Pengalaman</b></th>
										<th><b>Usia</b></th>
										<th><b>Jurusan</b></th>
										<th><b>Masa Kerja</b></th>
                                    	<th><b>NCF</b></th>
										<th><b>NSF</b></th>
										<th><b>NILAI AKHIR</b></th>
                                    </thead>
                                    <tbody>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM pegawai where status='N' ORDER BY nip DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
	$gap1=$r[id_usia] - $r2[id_usia];
	$gap3=$r[id_pendidikan]- $r2[id_pendidikan];
	$gap4=$r[id_jurusan]- $r2[id_jurusan];
	$gap5=$r[id_riwayat]- $r2[id_riwayat];
	$gap6=$r[id_masa]- $r2[id_masa];
	
	$g1=mysql_query("SELECT * FROM ketentuan WHERE selisih='$gap1'");
    $rg1=mysql_fetch_array($g1);
	$ng1=$rg1[nilai];
	
	$g3=mysql_query("SELECT * FROM ketentuan WHERE selisih='$gap3'");
    $rg3=mysql_fetch_array($g3);
	$ng3=$rg3[nilai];
	
	$g4=mysql_query("SELECT * FROM ketentuan WHERE selisih='$gap4'");
    $rg4=mysql_fetch_array($g4);
	$ng4=$rg4[nilai];
	
	$g5=mysql_query("SELECT * FROM ketentuan WHERE selisih='$gap5'");
    $rg5=mysql_fetch_array($g5);
	$ng5=$rg5[nilai];
	
	$g6=mysql_query("SELECT * FROM ketentuan WHERE selisih='$gap6'");
    $rg6=mysql_fetch_array($g6);
	$ng6=$rg6[nilai];

	$ncf=($ng1+$ng3+$ng5)/3;
	$nsf=($ng6+$ng4)/2;
	
	$akhir=(($ncf *.60) + ($nsf *.40));
	
										echo " 
										<form action='$aksi?module=analisis&act=input' method='post'>
										<tr>
                                        	<td>$no</td>
											<td>$r[nip]</td>
                                        	<td>$r[nm_pegawai]</td>
											<td>$ng3</td>
											<td>$ng5</td>
											<td>$ng1</td>
											<td>$ng4</td>
											<td>$ng6</td>
                                        	<td>".round($ncf,2)."</td>
											<td>$nsf</td>
											<td>$akhir  <input type='hidden' name='n_akhir[]' value='$akhir' >
											<input type='hidden' name='nip[]' value='$r[nip]' >
											</td>
                                        </tr>";
										$no++;
										}  
										echo "
										<tr>
                                        	<td colspan=10><b>KLIK SIMPAN UNTUK MENENTUKAN RANKING...</b></td>
											<td><button type='submit' class='btn btn-info btn-fill pull-left'>Simpan</button></td>
											</form>
                                        </tr>";
										echo "
										</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM pegawai"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "
	<div id=paging>Hal: $linkHalaman</div><br>";					
    break;
	
case "rangking":
$edit=mysql_query("SELECT * FROM penempatan, bidang  WHERE penempatan.id_bidang=bidang.id_bidang and penempatan.id_bidang='$_SESSION[id_bidang]'");
    $r2=mysql_fetch_array($edit);
	
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
								<center><h4 class='title'><b>DATA HASIL REKOMENDASI PENEMPATAN PEGAWAI PADA BIDANG<br> $r2[nm_bidang]</b></h4></center>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>NIP</th>
                                    	<th>Nama pegawai</th>
										<th>Tempat lahir</th>
										<th>Tanggal</th>
										<th>Alamat</th>
										<th>Pendidikan</th>
										<th>Nilai Akhir</th>
										<th>Penempatan</th>
                                    </thead>
                                    <tbody>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM pegawai where status='N' ORDER BY n_akhir DESC LIMIT $posisi,$batas");
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
	if ($no < 6){
		
	$pesan="<a href='$aksi?module=analisis&act=penempatan&id=$r[nip]&id_bidang=$_SESSION[id_bidang]'><i class='pe-7s-diskette'>Tempatkan</i>";	
	}
	else
	{
	$pesan="Belum Ada Penempatan";	
		
	}
										echo "
										<tr>
                                        	<td>$no</td>
											<td>$r[nip]</td>
                                        	<td>$r[nm_pegawai]</td>
											<td>$r[tempat_lahir]</td>
											<td>$r[tgl_lahir]</td>
											<td>$r[alamat]</td>
											<td>$pendidikan</td>
											<td>$r[n_akhir]</td>
											<td>$pesan</td>   	
                                        </tr>";
										$no++;
										}  
										echo "
										</tbody>
									</table>
									<b>NOTE:</b><br>
									<b>Daftar Nama Pegawai Yang Direkomendasikan Pada Bidang $r2[nm_bidang].</b></td>
                            </div>
                        </div>
                    </div>
					";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM pegawai"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
break;
case "lihatpenempatan":
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <p class='category'><center><h4 class='title'><b>HASIL REKOMENDASI PENEMPATAN PEGAWAI BKPSDM KAB. INDRAMAYU</b></h4></center></p>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>NIP</th>
                                    	<th>Nama pegawai</th>
										<th>Tempat lahir</th>
										<th>Tanggal</th>
										<th>Alamat</th>
										<th>Pendidikan</th>
										<th>Tgl Penempatan</th>
										<th>Penempatan</th>
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
                                       echo " <tr>
                                        	<td>$no</td>
											<td>$r[nip]</td>
                                        	<td>$r[nm_pegawai]</td>
											<td>$r[tempat_lahir]</td>
											<td>$r[tgl_lahir]</td>
											<td>$r[alamat]</td>
											<td>$pendidikan</td>
											<td>$r[tgl_penempatan]</td>
											<td>$r[nm_bidang]</td>
                                        	
                                        </tr>";
										$no++;
	}  
                                    echo"</tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM pegawai"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
break;
		
case "editbidang":
    $edit=mysql_query("SELECT * FROM bidang WHERE id_bidang='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Bidang</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=bidang&act=update' method='post'>
								<input type='hidden' name='id' value='$r[nm_bidang]'  >
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Nama Bidang</label>
                                                <input type='text' name='nm_bidang' value='$r[nm_bidang]' class='form-control' >
                                            </div>
                                        </div>    
                                    </div>
                                    <button type='submit' class='btn btn-info btn-fill pull-left'>Update</button>
                                    <div class='clearfix'></div>
                                </form>
                            </div>
                        </div>
                    </div>
";
break;
  }
	  
?>