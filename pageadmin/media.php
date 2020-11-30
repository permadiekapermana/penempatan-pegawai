<?php
  error_reporting(0);
  session_start(0); 
  ?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/logo.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>BKPSDM Kab. Indramayu</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>
<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/bkpsdm-1.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text">
                    PROFILE MATCHING
                </a>
            </div>

            <ul class="nav">
               	<?php if ($_SESSION['leveluser']=='admin'){ ?> 
                <li>
                    <a href="?module=user">
                        <i class="pe-7s-user"></i>
                        <p>Admin</p>
                    </a>
                </li>
                <li>
                    <a href="?module=pegawai">
                        <i class="pe-7s-note2"></i>
                        <p>Profil Pegawai</p>
                    </a>
                </li>
				<li>
                    <a href="?module=bidang">
                        <i class="pe-7s-news-paper"></i>
                        <p>Bidang</p>
                    </a>
                </li>
                <li>
                    <a href="?module=penempatan">
                        <i class="pe-7s-news-paper"></i>
                        <p>Kriteria Penempatan Pada Bidang</p>
                    </a>
                </li>
				<li>
                    <a href="?module=analisis">
                        <i class="pe-7s-science"></i>
                        <p>Analisis Penempatan Pegawai</p>
                    </a>
                </li>
                <li>
                    <a href="?module=laporan">
                        <i class="pe-7s-note2"></i>
                        <p>Laporan</p>
                    </a>
                </li>
             		<?php } elseif ($_SESSION['leveluser']=='kepalabidang'){ ?> 
				<li>
                    <a href="?module=analisis">
                        <i class="pe-7s-science"></i>
                        <p>Analisis Penempatan Pegawai</p>
                    </a>
                </li>
				<?php } else { ?> 
				<li>
                    <a href="?module=laporan">
                        <i class="pe-7s-map-marker"></i>
                        <p>Laporan</p>
                    </a>
                </li>
				<?php  }?>    
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">REKOMENDASI PENEMPATAN PEGAWAI DI BKPSDM KAB. INDRAMAYU</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										Kriteria
										<b class="caret"></b>
									</p>
                              </a>
                              <ul class="dropdown-menu">
								<li><a href="?module=kriteria">Kriteria Penilaian</a></li>
									<li class="divider"></li>	
								<li><a href="?module=ketentuan">Ketentuan</a></li>
								<li><a href="?module=password">Ubah Password</a></li>
									<li class="divider"></li>
                              </ul>
                        </li>
                        <li>
							  <a href="logout.php">
                                <p>Log out</p>
                              </a>
                        </li>
						
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>
		<div class="content">
           <div class="container-fluid">
                <div class="row">
				<?php include "content.php"; ?> 
				</div>
			</div>
		</div>
        <footer class="footer">
            <div class="container-fluid">
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a> Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kab. Indramayu </a>
                </p>
            </div>
        </footer>
    </div>
</div>
</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
