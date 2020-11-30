<?php
$pel="KR.";
$y=substr($pel,0,2);
$query=mysql_query("select * from kriteria where substr(id_kriteria,1,2)='$y' order by id_kriteria desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['id_kriteria'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_kriteria/aksi_kriteria.php";
switch($_GET[act]){

  // Tampil Kriteria
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'> 
								<a href='?module=kriteria&act=tambahkriteria'> <p class='category'>Tambah Kriteria Penilaian</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>Kode Kriteria</th>
                                    	<th>Kriteria Penilaian</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM kriteria ORDER BY id_kriteria DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
									echo "  <tr>
                                            <td>$no</td>
										    <td><a href='?module=kriteria&act=tambahdetail&id=$r[id_kriteria]'>$r[id_kriteria]</a></td>
                                            <td>$r[nm_kriteria]</td>
                                            <td><a href='?module=kriteria&act=editkriteria&id=$r[id_kriteria]'><i class='pe-7s-diskette'>Edit</i></a>
												<a href='$aksi?module=kriteria&act=hapus&id=$r[id_kriteria]'\ onClick=\"return confirm ('Anda Yakin Menghapus Data Ini?')\"><i class='pe-7s-junk'>Hapus</i></a></td>
										    </tr>";
									$no++;
	}  
									echo"</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM kriteria"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "<div id=paging>Hal: $linkHalaman</div><br>";
break;
	
case "tambahkriteria":
	echo "
	<div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Kriteria Penilaian</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=kriteria&act=input' method='post'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Kode Kriteria</label>
                                                <input type='text' name='id_kriteria' value='$nopel' class='form-control' placeholder='Kode Kriteria' >
                                            </div>
                                        
                                            <div class='form-group'>
                                                <label>Kriteria Penilaian</label>
                                                <input type='text' name='nm_kriteria' class='form-control' placeholder='Kriteria Penilaian' >
                                            </div>
                                        </div>   
                                    </div>
									<br>
                                    <button type='submit' class='btn btn-info btn-fill pull-left'>Simpan</button>
                                    <div class='clearfix'></div>
                                </form>
                            </div>
                        </div>
                    </div>
";
break;
case "tambahdetail":

  if (empty($_GET[id])){
  $_SESSION[id_kriteria] = $_SESSION[id_kriteria] ;
  }
  else{
	   session_start();
	  
	$_SESSION[id_kriteria]     = $_GET[id];
  }
	echo "
	<div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>  
								 <center><p><b><h4 class='title'>DETAIL KRITERIA PADA $_SESSION[id_kriteria]</center></b></p></h4>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>Detail Kriteria</th>
                                    	<th>Skor</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
									
									echo "
									<form action='$aksi?module=kriteria&act=simpan' method='post'>
									<input type='hidden' name='id_kriteria' value='$_SESSION[id_kriteria]' class='form-control' >									
										<tr>
                                        	<td>...</td>
											<td><input type='text' name='nama_detail' class='form-control' ></td>
                                        	<td><input type='text' name='skor' class='form-control' ></td>
                                        	<td><button type='submit' class='btn btn-info btn-fill pull-left'>Simpan</button></form></td>
                                        </tr>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM detail_kriteria where id_kriteria='$_SESSION[id_kriteria]' ORDER BY id_detail DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
                                       echo " <tr>
                                        	<td>$no</td>
											<td>$r[nama_detail]</td>
                                        	<td>$r[skor]</td>
                                        	<td><a href='?module=kriteria&act=editdetail&id=$r[id_detail]'><i class='pe-7s-diskette'>Edit</i></a>
												<a href='$aksi?module=kriteria&act=delete&id=$r[id_detail]'\ onClick=\"return confirm ('Anda Yakin Menghapus Data Ini?')\"><i class='pe-7s-junk'>Hapus</i></a></td>
											  </tr>";
										$no++;
	}  
                                    echo"</tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM kriteria"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
break;

case "editdetail":
 $edit=mysql_query("SELECT * FROM detail_kriteria WHERE id_detail='$_GET[id]'");
    $r=mysql_fetch_array($edit);

  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                
                              
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>Detail Kriteria</th>
                                    	<th>Skor</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
									
									echo "
									<form action='$aksi?module=kriteria&act=update2' method='post'>
									<input type='hidden' name='id' value='$r[id_detail]' class='form-control' >									
									<tr>
                                        	<td>..::..</td>
											<td><input type='text' name='nama_detail' value='$r[nama_detail]' class='form-control' ></td>
                                        	<td><input type='text' name='skor' value='$r[skor]' class='form-control' ></td>
                                        	<td>
											<button type='submit' class='btn btn-info btn-fill pull-left'>Update</button></form></td>
                                        </tr>";
									  	
                                    echo"</tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					";
										   $jmldata = mysql_num_rows(mysql_query("SELECT * FROM kriteria"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
break;
		
case "editkriteria":
    $edit=mysql_query("SELECT * FROM kriteria WHERE id_kriteria='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit kriteria Penilaian</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=kriteria&act=update' method='post'>
								<input type='hidden' name='id' value='$r[id_kriteria]'  >
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>kriteria Penilaian</label>
                                                <input type='text' name='nm_kriteria' value='$r[nm_kriteria]' class='form-control' >
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