<?php
$pel="MS.";
$y=substr($pel,0,2);
$query=mysql_query("select * from masa where substr(id_masa,1,2)='$y' order by id_masa desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['id_masa'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_masa/aksi_masa.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                
                               <a href='?module=masa&act=tambahmasa'> <p class='category'>Tambah Masa Kerja</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>Kode Masa Kerja</th>
                                    	<th>Masa Kerja</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
									  	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM masa ORDER BY id_masa DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
                                       echo " <tr>
                                        	<td>$no</td>
											<td>$r[id_masa]</td>
                                        	<td>$r[nm_masa]</td>
                                        	<td><a href='?module=masa&act=editmasa&id=$r[id_masa]'><i class='pe-7s-diskette'>Edit</i></a>
								<a href='$aksi?module=masa&act=hapus&id=$r[id_masa]' ><i class='pe-7s-junk'>Hapus</i></a></td>
                                        </tr>";
										$no++;
	}  
                                    echo"</tbody>
                                </table>

                            </div>
                        </div>
                    </div>
					";
										   $jmldata = mysql_num_rows(mysql_query("SELECT * FROM masa"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div id=paging>Hal: $linkHalaman</div><br>";
						
    break;
	
case "tambahmasa":
  echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Masa Kerja</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=masa&act=input' method='post'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Kode Kerja</label>
                                                <input type='text' name='id_masa' value='$nopel' class='form-control' placeholder='Masa Kerja' >
                                            </div>
                                        
                                            <div class='form-group'>
                                                <label>Masa Kerja</label>
                                                <input type='text' name='nm_masa' class='form-control' placeholder='Masa Kerja' >
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
		
case "editmasa":
    $edit=mysql_query("SELECT * FROM masa WHERE id_masa='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Masa Kerja</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=masa&act=update' method='post'>
								<input type='hidden' name='id' value='$r[id_masa]'  >
                                    <div class='row'>
                                        
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Masa Kerja</label>
                                                <input type='text' name='nm_masa' value='$r[nm_masa]' class='form-control' >
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