<?php 
	session_start();
	include 'config.php';
	error_reporting(0);
 ?>

 <!DOCTYPE html>
<html>
  <head>
    <title>SELAMAT DATANG</title>
    <base href="http://127.0.0.1/inventaris/signup.php">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-bg">
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-12">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.php">INVENTARIS GEDUNG AF</a></h1>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>PENDAFTARAN</h6>
			                <div class="social">
	                            <div class="division">
	                                <?php if($_GET["pesan"]){ ?>
	                                <span style="color: red;"><?php echo $_GET["pesan"]; ?></span>
	                                <?php }else{ ?>
	                               <span>Isikan Data Dengan Benar</span>
	                                <?php } ?>
	                            </div>
	                        </div>
	                        <form action="" method="post">
			                <input class="form-control" type="text" name="username" placeholder="Username">
			                <input class="form-control" type="password" name="password" placeholder="Password">
			                <input class="form-control" type="password" name="password2" placeholder="Re-Passowrd">
			                <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap">
			                <input class="form-control" type="email" name="email" placeholder="Email">
			                <div class="action">
			                	<input type="submit" class="btn btn-primary signup"  name="daftar" value="DAFTAR">
			                </div>                
			            </form>
			            </div>
			        </div>

			        <div class="already">
			            <p>Already have an account?</p>
			            <a href="http://127.0.0.1/inventaris/login">Log in</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>

	<?php 
		if(isset($_POST["daftar"])){
			$username = $_POST["username"];
			$password = $_POST["password"];
			$password2 = $_POST["password2"];
			$nama = $_POST["nama"];
			$email = $_POST["email"];
			if(empty($username) || empty($password) || empty($password2) || empty($nama) || empty($email)){
				$pesan = "Maaf Pastikan tidak ada data yang kosong";
				echo "<script>window.location=('http://127.0.0.1/inventaris/signup?pesan=$pesan')</script>";
			}else if($password != $password2){
				$pesan = "Password Tidak Sama";
				echo "<script>window.location=('http://127.0.0.1/inventaris/signup?pesan=$pesan')</script>";
			}else{
				$q=mysql_query("Select * from tb_user");
				$cek = mysql_fetch_array($q);
				if($username == $cek["username"] || $email == $cek["email"]){
						$pesan = "Maaf Userame atau Email Sudah terpakai";
				echo "<script>window.location=('http://127.0.0.1/inventaris/signup?pesan=$pesan')</script>";
				}else{
					$q1 = mysql_query("insert into tb_user set nama='$nama',password='$password',username='$username',email='$email',level='user'");
					if($q1){
						echo "<script>window.alert('Pendaftaran Berhasil, Silahkan Login Terlebih Dahulu!')</script>";
						echo "<script>window.location=('http://127.0.0.1/inventaris/login')</script>";
					}
				}
			}
		}
	 ?>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>