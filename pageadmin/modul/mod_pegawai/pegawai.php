<?php
$pel="NIP.";
$y=substr($pel,0,2);
$query=mysql_query("select * from pegawai where substr(nip,1,2)='$y' order by nip desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['nip'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_pegawai/aksi_pegawai.php";
switch($_GET[act]){

  // Tampil Pegawai
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <a href='?module=pegawai&act=tambahpegawai'> <p class='category'>Tambah Pegawai</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
                                    	<th>NIP</th>
										<th>Nama Pegawai</th>
										<th>Jenis Kelamin</th>
										<th>Tempat Lahir</th>
										<th>Tanggal Lahir</th>
										<th>Usia</th>
										<th>Alamat</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM pegawai where id_bidang ='' and status='N' ORDER BY nip DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
	$edit=mysql_query("SELECT * FROM detail_kriteria  WHERE id_kriteria='KR.001' and skor='$r[id_pendidikan]'");
    $r2=mysql_fetch_array($edit);
	
	$edit2=mysql_query("SELECT * FROM detail_kriteria  WHERE id_kriteria='KR.004' and skor='$r[id_jurusan]'");
    $r22=mysql_fetch_array($edit2);
	                   echo "  <tr>
                                        	<td>$no</td>
                                        	<td>$r[nip]</td>
											<td>$r[nm_pegawai]</td>
											<td>$r[jen_kel]</td>
											<td>$r[tempat_lahir]</td>
											<td>$r[tgl_lahir]</td>
											<td>$r[usia_skrg] Tahun</td>
											<td>$r[alamat]</td>
                                        	<td><a href='?module=pegawai&act=editpegawai&id=$r[nip]'><i class='pe-7s-diskette'>Edit</i></a>
								                <a href='$aksi?module=pegawai&act=hapus&id=$r[nip]'\ onClick=\"return confirm ('Anda Yakin Menghapus Data Ini?')\"><i class='pe-7s-junk'>Hapus</i></a></td>
                                            </tr>";
									$no++;
	}  
									echo "	</tbody>
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
	
case "tambahpegawai":
	echo "
	<div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
								<h4 class='title'>Tambah Pegawai</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=pegawai&act=input' method='post'>
                                    <div class='row'>
                                        <div class='col-md-2'>
                                            <div class='form-group'>
                                                <label>NIP</label>
                                                <input type='text' class='form-control' name='nip' value='$nopel' placeholder='NIP' >
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label>Nama Pegawai</label>
                                                <input type='text' class='form-control' name='nm_pegawai' placeholder='Nama Pegawai' >
                                            </div>
                                        </div>
									</div>
									<div class='row'>
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Tempat Lahir</label>
                                                <input type='type' class='form-control' name='tempat_lahir' placeholder='Tempat Lahir' >
                                            </div>
                                        </div>
                                        <div class='col-md-2'>
                                            <div class='form-group'>
                                                <label>Tanggal Lahir</label>
                                                <input type='date' class='form-control' name='tgl_lahir' placeholder='Tanggal Lahir' >
                                            </div>
                                        </div>
                                        <div class='col-md-3'>
                                            <div class='form-group'>
                                                <label>Jenis Kelamin</label><br>
                                                <input type=radio name='jen_kel' value='Laki-laki' checked> Laki-laki <br>   
												<input type=radio name='jen_kel' value='Perempuan'> Perempuan
                                            </div>
                                        </div>
									</div>
									<div class='row'>
                                        <div class='col-md-8'>
                                            <div class='form-group'>
                                                <label>Alamat</label>
												<textarea rows='4' cols='50' class='form-control' name='alamat' placeholder='Alamat'></textarea>
                                            </div>
										</div>
									</div>
									<div class='row'>
										<div class='col-md-4'>
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
										<div class='col-md-4'>
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
										<div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Jurusan Pendidikan</label>
												<select name='id_jurusan' class='form-control'>
            <option value=0 selected>- Pilih Jurusan -</option>";
            $tampil=mysql_query("SELECT * FROM detail_kriteria where  id_kriteria='KR.004' ORDER BY skor ASC");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[skor]>$r[nama_detail]</option>";
              }
    echo "</select>
											</div>
										</div>
										<div class='col-md-4'>
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
";
break;
		
case "editpegawai":
    $edit=mysql_query("SELECT * FROM pegawai WHERE nip='$_GET[id]'");
    $r=mysql_fetch_array($edit);
	
	echo "
	<div class='col-md-12'>
                        <div class='card'>
							<div class='header'>
                                <h4 class='title'>Edit Profil Pegawai</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=pegawai&act=update' method='post'>
                                    <div class='row'>
									<div class='col-md-2'>
                                            <div class='form-group'>
                                                <label>NIP</label>
												<input type='text' class='form-control' name='id' value='$r[nip]' placeholder='NIP' >
												</div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label>Nama Pegawai</label>
												<input type='text' class='form-control' name='nm_pegawai' value='$r[nm_pegawai]' placeholder='Nama Pegawai' >
                                            </div>
                                        </div>
										</div>									
									<div class='row'>								
                                    <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Tempat Lahir</label>
                                                <input type='text' class='form-control' name='tempat_lahir' value='$r[tempat_lahir]' placeholder='tempat lahir' >
												</div>
                                        </div> 
										<div class='col-md-2'>
                                            <div class='form-group'>
                                                <label>Tanggal Lahir</label>
                                                <input type='date' class='form-control' name='tgl_lahir' value='$r[tgl_lahir]' placeholder='Tanggal Lahir' >
                                            </div>
										</div>
										<div class='col-md-2'>
                                            <div class='form-group'>
                                                <label>Jenis Kelamin</label><br>";                                                
                                                if ($r[jen_kel]=="Laki-laki"){
                                                echo"
                                                <input type=radio name='jen_kel' value='Laki-laki' checked> Laki-laki<br>
                                                <input type=radio name='jen_kel' value='Perempuan'> Perempuan";
                                                }
                                                else
                                                {
                                                echo"
                                                <input type=radio name='jen_kel' value='Laki-laki'> Laki-laki<br>
                                                <input type=radio name='jen_kel' value='Perempuan' checked> Perempuan";
                                                }
                                                echo"								
                                            </div>
                                        </div> 
									</div>																	
									<div class='row'>
                                        <div class='col-md-8'>
                                            <div class='form-group'>
                                                <label>Alamat</label>
                                                <textarea name='alamat' class='form-control' >$r[alamat]</textarea>
                                            </div>
                                        </div>
										</div>
                                    <div class='row'>
                                        <div class='col-md-4'>
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
                                        <div class='col-md-4'>
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
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label>Jurusan Pendidikan</label>
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
										<div class='col-md-4'>
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