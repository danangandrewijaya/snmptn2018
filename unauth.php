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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title><?php echo "SNMPTN 2018 - Universitas Diponegoro";?></title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet"> 
    <!-- Custom Fonts -->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <style>
        .form-error{
          padding: 10px 10px;
          color: #d44950;
          text-align: center;
          background-color: #f2dede; 
    }
    </style>
</head>
<body>
<!--	<div id="wrapper">-->
<!--
		<div id="header">
			<h1>SNMPTN 2018 - UNDIP</h1>
		</div>
-->
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
					include "app/unauths/login.php";
				}
			?>
		</div>
<!--
		<footer>
			copyright &copy; SNMPTN 2018 - UNDIP
		</footer>
-->
<!--	</div>-->
        <!-- jQuery -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
        <!-- Custom Theme JavaScript -->
    <script src="assets/dist/js/sb-admin-2.js"></script>
</body>
</html>