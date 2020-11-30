<?php
$pel="BI.";
$y=substr($pel,0,2);
$query=mysql_query("select * from bidang where substr(id_bidang,1,2)='$y' order by id_bidang desc limit 0,1");
$row=mysql_num_rows($query);
$data=mysql_fetch_array($query);

if ($row>0){
$no=substr($data['id_bidang'],-3)+1;}
else{
$no=1;
}
$nourut=1000+$no;
$nopel=$pel.substr($nourut,-3);
$aksi="modul/mod_bidang/aksi_bidang.php";
switch($_GET[act]){

  // Tampil Kategori
  default:
  echo "
  <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
								<a href='?module=bidang&act=tambahbidang'> <p class='category'>Tambah Bidang</p></a>
                            </div>
                            <div class='content table-responsive table-full-width'>
                                <table class='table table-hover table-striped'>
                                    <thead>
                                        <th>No</th>
										<th>Kode Bidang</th>
                                    	<th>Nama Bidang</th>
                                    	<th>Aksi</th>
                                    </thead>
                                    <tbody>";
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	$tampil = mysql_query("SELECT * FROM bidang ORDER BY id_bidang DESC LIMIT $posisi,$batas");
	$no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){	
									echo "  <tr>
                                        	<td>$no</td>
											<td>$r[id_bidang]</td>
                                        	<td>$r[nm_bidang]</td>
                                        	<td><a href='?module=bidang&act=editbidang&id=$r[id_bidang]'><i class='pe-7s-diskette'>Edit</i></a>
												<a href='$aksi?module=bidang&act=hapus&id=$r[id_bidang]'\ onClick=\"return confirm ('Anda Yakin Menghapus Data Ini?')\"><i class='pe-7s-junk'>Hapus</i></a></td>
											</tr>";
   									$no++;
	}  								echo "	</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM bidang"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);						
break;
	
case "tambahbidang":
	echo "
	<div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Tambah Bidang</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=bidang&act=input' method='post'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Kode Bidang</label>
                                                <input type='text' name='id_bidang' value='$nopel' class='form-control' placeholder='Nama Bidang' >
                                            </div>
                                        
                                            <div class='form-group'>
                                                <label>Nama Bidang</label>
                                                <input type='text' name='nm_bidang' class='form-control' placeholder='Nama Bidang' >
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
		
case "editbidang":
    $edit=mysql_query("SELECT * FROM bidang WHERE id_bidang='$_GET[id]'");
    $r=mysql_fetch_array($edit);

     echo "
 <div class='col-md-12'>
                        <div class='card'>
                            <div class='header'>
                                <h4 class='title'>Edit Bidang</h4>
                            </div>
                            <div class='content'>
                                <form action='$aksi?module=bidang&act=update' method='post'>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class='form-group'>
                                                <label>Nama Bidang</label>
												<input type='hidden' class='form-control' name='id' value='$r[id_bidang]' placeholder='nama bidang' >
                                                <input type='text' class='form-control' name='nm_bidang' value='$r[nm_bidang]' placeholder='nama bidang' >
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