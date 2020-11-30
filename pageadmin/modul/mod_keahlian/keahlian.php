<?php
$pel="SD.";
$y=substr($pel,0,2);
$query=mysql_query("select * from keahlian where substr(kd_keahlian,1,2)='$y' order by kd_keahlian desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['kd_keahlian'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_keahlian/aksi_keahlian.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                
                               <a href='?module=keahlian&act=tambahkeahlian'> <p class='category'>Here is Tambah Keahlian</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
                                    	<th>Nama keahlian</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
									  	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM keahlian ORDER BY id_keahlian DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
                                       echo " <tr>
                                        	<td>$no</td>
                                        	<td>$r[nm_keahlian]</td>
                                        	<td><a href='?module=keahlian&act=editkeahlian&id=$r[id_keahlian]'><i class='pe-7s-diskette'>Edit</i></a>
								<a href='$aksi?module=keahlian&act=hapus&id=$r[id_keahlian]' ><i class='pe-7s-junk'>Hapus</i></a></td>
                                        </tr>";
										$no++;
	}  
                                    echo"</tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					";
										   $jmldata = mysql_num_rows(mysql_query("SELECT * FROM keahlian"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
						
    break;
	
case "tambahkeahlian":
  echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Keahlian</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=keahlian&act=input' method='post'>
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Nama Keahlian</label>
                                                <input type='text' name='nm_keahlian' class='form-control' placeholder='Nama keahlian' >
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
		
case "editkeahlian":
    $edit=mysql_query("SELECT * FROM keahlian WHERE id_keahlian='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Keahlian</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=keahlian&act=update' method='post'>
								<input type='hidden' name='id' value='$r[id_keahlian]'  >
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Nama Keahlian</label>
                                                <input type='text' name='nm_keahlian' value='$r[nm_keahlian]' class='form-control' >
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