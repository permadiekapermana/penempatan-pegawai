<?php
$pel="SD.";
$y=substr($pel,0,2);
$query=mysql_query("select * from status where substr(kd_status,1,2)='$y' order by kd_status desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['kd_status'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_status/aksi_status.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                
                               <a href='?module=status&act=tambahstatus'> <p class='category'>Here is Tambah Status</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
                                    	<th>Nama status</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
									  	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM status ORDER BY id_status DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
                                       echo " <tr>
                                        	<td>$no</td>
                                        	<td>$r[nm_status]</td>
                                        	<td><a href='?module=status&act=editstatus&id=$r[id_status]'><i class='pe-7s-diskette'>Edit</i></a>
								<a href='$aksi?module=status&act=hapus&id=$r[id_status]' ><i class='pe-7s-junk'>Hapus</i></a></td>
                                        </tr>";
										$no++;
	}  
                                    echo"</tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					";
										   $jmldata = mysql_num_rows(mysql_query("SELECT * FROM status"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
						
    break;
	
case "tambahstatus":
  echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Status</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=status&act=input' method='post'>
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Nama Status</label>
                                                <input type='text' name='nm_status' class='form-control' placeholder='Nama status' >
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
		
case "editstatus":
    $edit=mysql_query("SELECT * FROM status WHERE id_status='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Status</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=status&act=update' method='post'>
								<input type='hidden' name='id' value='$r[nm_status]'  >
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Nama Status</label>
                                                <input type='text' name='nm_status' value='$r[nm_status]' class='form-control' >
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