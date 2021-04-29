<?php 
	session_start();
	include 'config.php';
	error_reporting(0);
 ?>

 <!DOCTYPE html>
<html>
  <head>
  	<base href="http://127.0.0.1/inventaris/login.php">
    <title>SELAMAT DATANG</title>
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
			                <h6>SELAMAT DATANG</h6>
			                <div class="social">
	                            <div class="division">
	                                <?php if($_GET["pesan"]){ ?>
	                                <span style="color: red;"><?php echo $_GET["pesan"]; ?></span>
	                                <?php }else{ ?>
	                               <span>Masukkan Username / Password</span>
	                                <?php } ?>
	                            </div>
	                        </div>
	                        <form action="" method="post">
			                <input class="form-control" type="text" name="username" placeholder="Username">
			                <input class="form-control" type="password" name="password" placeholder="Password">
			                <div class="action">
			                	<input type="submit" class="btn btn-primary signup"  name="login" value="LOGIN">
			                </div>                
			            </form>
			            </div>
			        </div>

			        <div class="already">
			            <p>Don't have an account yet?</p>
			            <a href="http://127.0.0.1/inventaris/signup">Sign Up</a>
			        </div>
			    </div>
			</div>
		</div>
	</div>

	<?php 
		if(isset($_POST["login"])){
			$username = $_POST["username"];
			$password = $_POST["password"];
			if(empty($username) || empty($password)){
				$pesan = "Maaf Kolom Username dan Password Tidak Boleh Kosong";
				echo "<script>window.location=('http://127.0.0.1/inventaris/login?pesan=$pesan')</script>";
			}else{
				$log = mysqli_query($koneksi,"select * from tb_user where username = '$username'");
				if(mysqli_num_rows($log)>0){
					$pass = mysqli_fetch_array($log);
					if($password==$pass["password"]){
						$_SESSION["id"] = $pass["user_id"];
						echo "<script>window.alert('Login Berhasil')</script>";
						echo "<script>window.location=('index.php')</script>";
					}else{
						$pesan = "Maaf Password Anda Salah";
				echo "<script>window.location=('http://127.0.0.1/inventaris/login?pesan=$pesan')</script>";
					}
				}else{
					$pesan = "Maaf Username Anda Salah";
				echo "<script>window.location=('http://127.0.0.1/inventaris/login?pesan=$pesan')</script>";
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