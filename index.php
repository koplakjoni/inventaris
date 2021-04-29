<?php 

	session_start();
	include 'config.php';
	error_reporting(0);
	if(!isset($_SESSION["id"])){
			echo "<script>window.alert('Silahkan Login Terlebih Dahulu')</script>";
						echo "<script>window.location=('http://127.0.0.1/inventaris/login')</script>";
	}
		$a = mysqli_fetch_array(mysqli_query($koneksi,"select * from tb_user where user_id = '$_SESSION[id]'"));
 ?>
 <!DOCTYPE html>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<base href="http://127.0.0.1/inventaris/index.php">
  <head>
    <title>SELAMAT DATANG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
     
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.twbsPagination.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
  
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">INVENTARIS GEDUNG AF</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  <div class="input-group form">
	                       <input type="text" class="form-control" placeholder="Search...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
	                  </div>
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $a["username"]; ?> <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href=".?log=out">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <?php if($a[level]=="admin"){  ?>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Kontrol Barang
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                         	<li><a href="./index/barang/">Barang</a></li>
                            <li><a href="./index/barang_masuk/">Barang Masuk</a></li>
                            <li><a href="./index/barang_keluar/">Barang Keluar</a></li>
                              <li><a href="./index/kategori/">Kategori</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Transaksi
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="./index/pinjam_barang/">Pinjam Barang</a></li>
                            <li><a href="./index/pinjam_details/">Detail Peminjaman</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
		  </div>
		  	<div class="row">

		  		<?php
		$pages_dir = 'pages';
		if(!empty($_GET['p'])){
			$pages = scandir($pages_dir, 0);
			unset($pages[0], $pages[1]);
 
			$p = $_GET['p'];
			if(in_array($p.'.php', $pages)){
				include($pages_dir.'/'.$p.'.php');
			} else {
				echo "tidak di temukan";
			}
		} else {
			echo "<script>window.location=('./index/awal/')</script>";
		}
		?>
		  		
		  	</div>
		 
		</div>
		
    </div>
    <footer >
         <div class="container">
            <div class="copy text-center">
               Copyright 2017 <a href='#'>Iqbalcakep.com</a>
            </div>
            
         </div>
      </footer>

  

  </body>
</html>
<?php if($_GET["log"]=="out"){
	unset($_SESSION["id"]);
		echo "<script>window.alert('Logout Berhasil')</script>";
						echo "<script>window.location=('http://127.0.0.1/inventaris/login')</script>";
} ?>