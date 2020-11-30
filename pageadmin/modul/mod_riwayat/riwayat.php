<?php
$pel="PK.";
$y=substr($pel,0,2);
$query=mysql_query("select * from pengalaman where substr(id_riwayat,1,2)='$y' order by id_riwayat desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['id_riwayat'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_riwayat/aksi_riwayat.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                
                               <a href='?module=riwayat&act=tambahriwayat'> <p class='category'>Tambah Pengalaman Kerja</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>Kode Pengalaman Kerja</th>
                                    	<th>Pengalaman Kerja</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
									  	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM pengalaman ORDER BY id_riwayat DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
                                       echo " <tr>
                                        	<td>$no</td>
											<td>$r[id_riwayat]</td>
                                        	<td>$r[nm_riwayat]</td>
                                        	<td><a href='?module=riwayat&act=editriwayat&id=$r[id_riwayat]'><i class='pe-7s-diskette'>Edit</i></a>
								<a href='$aksi?module=riwayat&act=hapus&id=$r[id_riwayat]' ><i class='pe-7s-junk'>Hapus</i></a></td>
                                        </tr>";
										$no++;
	}  
                                    echo"</tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					";
										   $jmldata = mysql_num_rows(mysql_query("SELECT * FROM pengalaman"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
						
    break;
	
case "tambahriwayat":
  echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Pengalaman Kerja</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=riwayat&act=input' method='post'>
                                    <div class='row'>
										<div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Kode Pengalaman Kerja</label>
                                                <input type='text' name='id_riwayat' value='$nopel' class='form-control' placeholder='Nama Pengalaman' >
                                            </div>
                                        
                                        
											
                                            <div class='form-group'>
                                                <label>Pengalaman Kerja</label>
                                                <input type='text' name='nm_riwayat' class='form-control' placeholder='Nama Pengalaman' >
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
		
case "editriwayat":
    $edit=mysql_query("SELECT * FROM pengalaman WHERE id_riwayat='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Pengalaman Kerja</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=riwayat&act=update' method='post'>
								<input type='hidden' name='id' value='$r[id_riwayat]'  >
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Pengalaman Kerja</label>
                                                <input type='text' name='nm_riwayat' value='$r[nm_riwayat]' class='form-control' >
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