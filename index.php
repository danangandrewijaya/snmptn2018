<?php
	(!isset($_SESSION))?session_start():"";

//    error_reporting(0);
	include('libs/Core.php');					
	include('libs/Koneksi.php');				
	include('libs/User.php');				
//	include('libs/fetch.php');				
	$core = new Core;

    if(isset($_GET['page'])){
        $filename = "app/views/".$_GET['page'].".php";
        if(file_exists($filename)) {	
            require_once($filename);
        } else {
            include "app/errors/404.php";
        }
    } else {
        include "app/views/verifikasi.php";
    }
?>
