<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
include "../config/fungsi_rupiah.php";

// Bagian Home
if ($_GET[module]=='home'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='kepalabidang' or $_SESSION['leveluser']=='kepalabkpsdm'){
  echo "<center><h2><b>Selamat Datang!</b></h2></center>
          <center><b>$_SESSION[namalengkap]</b>...
		  <center> Selamat datang di halaman Administrator.</center>
		  <center>Silahkan klik menu pilihan yang berada 
          di sebelah kiri untuk mengelola content website. </p></center>
          <img src='../images/bkpsdm1.jpg' width='50%' class='center' alt=''>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
  }
}

// Bagian User
elseif ($_GET[module]=='user'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_users/users.php";
  }
}

// Bagian Password
elseif ($_GET[module]=='password'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='kepalabidang' or $_SESSION['leveluser']=='kepalabkpsdm'){
    include "modul/mod_password/password.php";
  }
}

// Bagian Kriteria Penilaian
elseif ($_GET[module]=='pendidikan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_pendidikan/pendidikan.php";
  }
}
elseif ($_GET[module]=='usia'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_usia/usia.php";
  }
}
elseif ($_GET[module]=='riwayat'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_riwayat/riwayat.php";
  }
}
elseif ($_GET[module]=='masa'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_masa/masa.php";
  }
}
elseif ($_GET[module]=='jurusan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_jurusan/jurusan.php";
  }
}

// Bagian Profi Pegawai
elseif ($_GET[module]=='pegawai'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_pegawai/pegawai.php";
  }
}

// Bagian Bobot Nilai
elseif ($_GET[module]=='ketentuan'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_ketentuan/ketentuan.php";
  }
}

// Bagian Bidang
elseif ($_GET[module]=='bidang'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_bidang/bidang.php";
  }
}

// Bagian Kriteria Penempatan Bidang
elseif ($_GET[module]=='penempatan'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='kepalabidang'){
    include "modul/mod_penempatan/penempatan.php";
  }
}

// Bagian Analisis Penempatan Pegawai
elseif ($_GET[module]=='analisis'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='kepalabidang'){
    include "modul/mod_analisis/analisis.php";
  }
}

// Bagian Laporan
elseif ($_GET[module]=='laporan'){
  if ($_SESSION['leveluser']=='admin' or $_SESSION['leveluser']=='kepalabkpsdm'){
    include "modul/mod_laporan/laporan.php";
  }
}

// Bagian Kriteria
elseif ($_GET[module]=='kriteria'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kriteria/kriteria.php";
  }
}
// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>