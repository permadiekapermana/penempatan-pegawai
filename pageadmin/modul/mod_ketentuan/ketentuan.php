<?php
$pel="SD.";
$y=substr($pel,0,2);
$query=mysql_query("select * from ketentuan where substr(kd_ketentuan,1,2)='$y' order by kd_ketentuan desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['kd_ketentuan'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_ketentuan/aksi_ketentuan.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <center><p><b><h3 class='title'>BOBOT NILAI GAP</center></b></p></h3>
                               <a href='?module=ketentuan&act=tambahketentuan'> <p class='category'>Tambah Bobot Nilai</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
                                    	<th>Selisih</th>
										<th>Nilai</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM ketentuan ORDER BY id_ketentuan ASC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
                                    echo " 	<tr>
                                        	<td>$no</td>
                                        	<td>$r[selisih]</td>
											<td>$r[nilai]</td>
                                        	<td><a href='?module=ketentuan&act=editketentuan&id=$r[id_ketentuan]'><i class='pe-7s-diskette'>Edit</i></a>
												<a href='$aksi?module=ketentuan&act=hapus&id=$r[id_ketentuan]'\ onClick=\"return confirm ('Anda Yakin Menghapus Data Ini?')\"><i class='pe-7s-junk'>Hapus</i></a></td>
											</tr>";
									$no++;
	}
                                    echo"</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM ketentuan"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
						
    break;
	
case "tambahketentuan":
	echo "
	<div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Bobot Nilai GAP</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=ketentuan&act=input' method='post'>
                                    <div class='row'>                                  
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Selisih</label>
                                                <input type='text' class='form-control' name='selisih' placeholder='Selisih' >
                                            </div>
                                        </div>
									</div>
									<div class='row'>
										<div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Nilai</label>
                                                <input type='text' class='form-control' name='nilai' placeholder='Nilai' >
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
		
case "editketentuan":
    $edit=mysql_query("SELECT * FROM ketentuan WHERE id_ketentuan='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Bobot Nilai GAP</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=ketentuan&act=update' method='post'>
								<input type='hidden' name='id' value='$r[nm_ketentuan]'  >
                                    <div class='row'>                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Selisih</label>
                                                <input type='text' name='selisih' value='$r[selisih]' class='form-control' >
                                            </div>
                                        </div>
										</div>
									<div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Nilai</label>
                                                <input type='text' name='nilai' value='$r[nilai]' class='form-control' >
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