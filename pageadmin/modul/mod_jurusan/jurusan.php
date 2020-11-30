<?php
$pel="JP.";
$y=substr($pel,0,2);
$query=mysql_query("select * from jurusan where substr(id_jurusan,1,2)='$y' order by id_jurusan desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['id_jurusan'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_jurusan/aksi_jurusan.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                
                               <a href='?module=jurusan&act=tambahjurusan'> <p class='category'>Tambah Jurusan Pendidikan</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>Kode Jurusan</th>
                                    	<th>Jurusan Pendidikan</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
									  	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM jurusan ORDER BY id_jurusan DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
                                       echo " <tr>
                                        	<td>$no</td>
											<td>$r[id_jurusan]</td>
                                        	<td>$r[nm_jurusan]</td>
                                        	<td><a href='?module=jurusan&act=editjurusan&id=$r[id_jurusan]'><i class='pe-7s-diskette'>Edit</i></a>
								<a href='$aksi?module=jurusan&act=hapus&id=$r[id_jurusan]' ><i class='pe-7s-junk'>Hapus</i></a></td>
                                        </tr>";
										$no++;
	}  
                                    echo"</tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					";
										   $jmldata = mysql_num_rows(mysql_query("SELECT * FROM jurusan"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
						
    break;
	
case "tambahjurusan":
  echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Jurusan Pendidikan</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=jurusan&act=input' method='post'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Kode </label>
                                                <input type='text' name='id_jurusan' value='$nopel' class='form-control' placeholder='Jurusan Pendidikan' >
                                            </div>
                                        
                                            <div class='form-group'>
                                                <label>Jurusan Pendidikan</label>
                                                <input type='text' name='nm_jurusan' class='form-control' placeholder='Jurusan Pendidikan' >
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
		
case "editjurusan":
    $edit=mysql_query("SELECT * FROM jurusan WHERE id_jurusan='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Jurusan Pendidikan</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=jurusan&act=update' method='post'>
								<input type='hidden' name='id' value='$r[id_jurusan]'  >
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Jurusan Pendidikan</label>
                                                <input type='text' name='nm_jurusan' value='$r[nm_jurusan]' class='form-control' >
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