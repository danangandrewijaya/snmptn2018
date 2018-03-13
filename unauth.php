<?php
	(!isset($_SESSION))?session_start():"";

//	error_reporting(0);
	include('libs/Koneksi.php');
	include('libs/User.php');				
	require_once('libs/Core.php');					
	$core = new Core;
	
?>
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='assets/css/style.css'>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<h1>SNMPTN 2018 - UNDIP</h1>
		</div>
		<nav>
			<ul>
				<li><a href="unauth.php">Home</a></li>
				<li><a href="unauth.php?page=login">Login</a></li>
			</ul>
		</nav>
		<div class="container">
			<?php
				if(isset($_GET['page'])){
					$filename = "app/unauths/".$_GET['page'].".php";
					if(file_exists($filename)) {	
						require_once($filename);
					} else {
						include "app/errors/404.php";
					}
				} else {
					echo "Selamat Datang";
				}
			?>
		</div>
		<footer>
			copyright &copy; SNMPTN 2018 - UNDIP
		</footer>
	</div>
</body>
</html>