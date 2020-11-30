<?php
$pel="SD.";
$y=substr($pel,0,2);
$query=mysql_query("select * from penempatan where substr(id_penempatan,1,2)='$y' order by id_penempatan desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['id_penempatan'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_penempatan/aksi_penempatan.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                               <center><p><b><h4 class='title'>KRITERIA PENILAIAN PEGAWAI UNTUK PENEMPATAN PADA BIDANG</center></b></p></h4>
                               <a href='?module=penempatan&act=tambahpenempatan'> <p class='category'>Tambah Penempatan Bidang</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
                                    	<th>Nama Bidang</th>
										<th>Pendidikan</th>
										<th>Pengalaman</th>
										<th>Usia</th>
										<th>Jurusan</th>
										<th>Masa Kerja</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM penempatan, bidang where penempatan.id_bidang=bidang.id_bidang ORDER BY penempatan.id_penempatan DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
                                       echo " <tr>
                                        	<td>$no</td>
                                        	<td>$r[nm_bidang]</td>
											<td>$r[id_pendidikan]</td>
											<td>$r[id_riwayat]</td>
											<td>$r[id_usia]</td>
											<td>$r[id_jurusan]</td>
											<td>$r[id_masa]</td>
                                        	<td><a href='?module=penempatan&act=editpenempatan&id=$r[id_penempatan]'><i class='pe-7s-diskette'>Edit</i></a>
												<a href='$aksi?module=penempatan&act=hapus&id=$r[id_penempatan]'\ onClick=\"return confirm ('Anda Yakin Menghapus Data Ini?')\"><i class='pe-7s-junk'>Hapus</i></a></td>
                                        </tr>";
										$no++;
	}  
                                    echo"</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM penempatan"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    break;
	
case "tambahpenempatan":
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Kriteria Penempatan Pada Bidang</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=penempatan&act=input2' method='post'>
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
    echo "</select>
										</div>   
                                    </div>
									</div>
                                 	<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Pendidikan Terakhir</label>
													 <select name='id_pendidikan' class='form-control'>
            <option value=0 selected>- Pilih Pendidikan -</option>";
            $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.001' ORDER BY skor ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[skor]>$r[nama_detail]</option>";
              }
    echo "</select>
										</div>   
                                    </div>
									</div>
									<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Pengalaman Kerja</label>
													<select name='id_riwayat' class='form-control'>
            <option value=0 selected>- Pilih Pengalaman -</option>";
            $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.002' ORDER BY skor ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[skor]>$r[nama_detail]</option>";
              }
    echo "</select>
										</div>     
                                    </div>
									</div>
									<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Usia</label>
													<select name='id_usia' class='form-control'>            
            <option value=0 selected>- Pilih Usia -</option>";
            $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.003' ORDER BY skor ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[skor]>$r[nama_detail]</option>";
              }
    echo "</select>
										</div>   
                                    </div>
									</div>
									<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Jurusan Pendidikan</label>
													<select name='id_jurusan' class='form-control'>
            <option value=0 selected>- Pilih Jurusan  -</option>";
            $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.004' ORDER BY skor ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[skor]>$r[nama_detail]</option>";
              }
    echo "</select>
                                        </div>   
                                    </div>
									</div>
									<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
												<label>Masa Kerja</label>
													<select name='id_masa' class='form-control'>
            <option value=0 selected>- Pilih Masa Kerja -</option>";
            $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.005' ORDER BY skor ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[skor]>$r[nama_detail]</option>";
              }
    echo "</select>
                                        </div>   
                                    </div>
									</div>
                                    <button type='submit' class='btn btn-info btn-fill pull-left'>Simpan</button>
                                    <div class='clearfix'></div>
                                </form>
                            </div>
                        </div>
                    </div>
					</div>
";
break;
		
case "editpenempatan":
    $edit=mysql_query("SELECT * FROM penempatan WHERE id_penempatan='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Kriteria Penempatan Pada Bidang</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=penempatan&act=update' method='post'>
								<input type='hidden' name='id' value='$r[id_penempatan]'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Bidang</label>
                                                <select name='id_bidang'  class='form-control'>";
          $tampil=mysql_query("SELECT * FROM bidang ORDER BY nm_bidang");
          if ($r[id_bidang]==0){
			echo "<option value=0 selected>- Pilih Bidang -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_bidang]==$w[id_bidang]){
              echo "<option value=$w[id_bidang] selected>$w[nm_bidang]</option>";
            }
            else{
              echo "<option value=$w[id_bidang]>$w[nm_bidang]</option>";
            }
          }
			echo "</select>
			
                                        </div>   
                                    </div>
									</div>									  						
									<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Pendidikan Terakhir</label>
												<select name='id_pendidikan'  class='form-control'>";
          $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.001' ORDER BY skor ASC");
          if ($r[id_pendidikan]==0){
            echo "<option value=0 selected>- Pilih Pendidikan -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_pendidikan]==$w[skor]){
              echo "<option value=$w[skor] selected>$w[nama_detail]</option>";
            }
            else{
              echo "<option value=$w[skor]>$w[nama_detail]</option>";
            }
          }											
			echo "</select>
         
										</div>   
                                    </div>
									</div>				
									<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Pengalaman Kerja</label>
                                                <select name='id_riwayat'  class='form-control'>";
			 $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.002' ORDER BY skor ASC");
          if ($r[id_riwayat]==0){
            echo "<option value=0 selected>- Pilih Pengalaman -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_riwayat]==$w[skor]){
              echo "<option value=$w[skor] selected>$w[nama_detail]</option>";
            }
            else{
              echo "<option value=$w[skor]>$w[nama_detail]</option>";
            }
          }
			echo "</select>
			
										</div>
                                    </div>
									</div>									
									<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Usia</label>
                                                <select name='id_usia'  class='form-control'>";
			 $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.003' ORDER BY skor ASC");
          if ($r[id_usia]==0){
            echo "<option value=0 selected>- Pilih Usia -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_usia]==$w[skor]){
              echo "<option value=$w[skor] selected>$w[nama_detail]</option>";
            }
            else{
              echo "<option value=$w[skor]>$w[nama_detail]</option>";
            }
          }
			echo "</select>
	
                                        </div>   
                                    </div>
									</div>
									<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Jurusan Terakhir</label>
                                                <select name='id_jurusan'  class='form-control'>";
			 $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.004' ORDER BY skor ASC");
          if ($r[id_jurusan]==0){
            echo "<option value=0 selected>- Pilih Jurusan -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_jurusan]==$w[skor]){
              echo "<option value=$w[skor] selected>$w[nama_detail]</option>";
            }
            else{
              echo "<option value=$w[skor]>$w[nama_detail]</option>";
            }
          }
			echo "</select>
			
                                        </div>   
                                    </div>
									</div>		
									<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Masa Kerja</label>
                                                <select name='id_masa'  class='form-control'>";
			 $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.005' ORDER BY skor ASC");
          if ($r[id_masa]==0){
            echo "<option value=0 selected>- Pilih Masa Kerja -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_masa]==$w[skor]){
              echo "<option value=$w[skor] selected>$w[nama_detail]</option>";
            }
            else{
              echo "<option value=$w[skor]>$w[nama_detail]</option>";
            }
          }
			echo "</select>
			  
                                        </div>   
                                    </div>
									</div>
                                    <button type='submit' class='btn btn-info btn-fill pull-left'>Simpan</button>
                                    <div class='clearfix'></div>
                                </form>
                            </div>
                        </div>
                    </div>
					</div>
";
break;
  }
	  
?>