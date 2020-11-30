<?php
$pel="PT.";
$y=substr($pel,0,2);
$query=mysql_query("select * from pendidikan where substr(id_pendidikan,1,2)='$y' order by id_pendidikan desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['id_pendidikan'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_pendidikan/aksi_pendidikan.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                
                               <a href='?module=pendidikan&act=tambahpendidikan'> <p class='category'>Tambah Pendidikan Terakhir</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>Kode Pendidikan Terakhir</th>
                                    	<th>Pendidikan Terakhir</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
									  	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM pendidikan ORDER BY id_pendidikan DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
                                       echo " <tr>
                                        	<td>$no</td>
											<td>$r[id_pendidikan]</td>
                                        	<td>$r[nm_pendidikan]</td>
                                        	<td><a href='?module=pendidikan&act=editpendidikan&id=$r[id_pendidikan]'><i class='pe-7s-diskette'>Edit</i></a>
								<a href='$aksi?module=pendidikan&act=hapus&id=$r[id_pendidikan]' ><i class='pe-7s-junk'>Hapus</i></a></td>
                                        </tr>";
										$no++;
	}  
                                    echo"</tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					";
										   $jmldata = mysql_num_rows(mysql_query("SELECT * FROM pendidikan"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
						
    break;
	
case "tambahpendidikan":
  echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Pendidikan Terakhir</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=pendidikan&act=input' method='post'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Kode Pendidikan Terakhir</label>
                                                <input type='text' name='id_pendidikan' value='$nopel' class='form-control' placeholder='Pendidikan Terakhir' >
                                            </div>
                                        
										
                                            <div class='form-group'>
                                                <label>Pendidikan Terakhir</label>
                                                <input type='text' name='nm_pendidikan' class='form-control' placeholder='Pendidikan Terakhir' >
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
		
case "editpendidikan":
    $edit=mysql_query("SELECT * FROM pendidikan WHERE id_pendidikan='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Pendidikan Terakhir</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=pendidikan&act=update' method='post'>
								<input type='hidden' name='id' value='$r[id_pendidikan]'  >
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Pendidikan Terakhir</label>
                                                <input type='text' name='nm_pendidikan' value='$r[nm_pendidikan]' class='form-control' >
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