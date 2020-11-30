<?php
$pel="US.";
$y=substr($pel,0,2);
$query=mysql_query("select * from usia where substr(id_usia,1,2)='$y' order by id_usia desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['id_usia'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_usia/aksi_usia.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                
                               <a href='?module=usia&act=tambahusia'> <p class='category'>Tambah Usia</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>Kode Usia</th>
                                    	<th>Usia</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
									  	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM usia ORDER BY id_usia DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
                                       echo " <tr>
                                        	<td>$no</td>
											<td>$r[id_usia]</td>
                                        	<td>$r[nm_usia]</td>
                                        	<td><a href='?module=usia&act=editusia&id=$r[id_usia]'><i class='pe-7s-diskette'>Edit</i></a>
								<a href='$aksi?module=usia&act=hapus&id=$r[id_usia]' ><i class='pe-7s-junk'>Hapus</i></a></td>
                                        </tr>";
										$no++;
	}  
                                    echo"</tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					";
										   $jmldata = mysql_num_rows(mysql_query("SELECT * FROM usia"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
						
    break;
	
case "tambahusia":
  echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Usia</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=usia&act=input' method='post'>
                                    <div class='row'>
									<div class='col-md-12'>
                                        <div class='form-group'>
                                                <label>Kode Usia</label>
                                                <input type='text' name='id_usia' value='$nopel' class='form-control' placeholder='Usia' >
                                            </div>
                                       									   
									   
                                    
                                            <div class='form-group'>
                                                <label>Usia</label>
                                                <input type='text' name='nm_usia' class='form-control' placeholder='Usia' >
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
		
case "editusia":
    $edit=mysql_query("SELECT * FROM usia WHERE id_usia='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Usia</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=usia&act=update' method='post'>
								<input type='hidden' name='id' value='$r[id_usia]'  >
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Usia</label>
                                                <input type='text' name='nm_usia' value='$r[nm_usia]' class='form-control' >
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