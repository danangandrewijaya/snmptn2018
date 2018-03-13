<?php
(!isset($_SESSION))?session_start():"";
if(!$_SESSION['isLogin']){
	header("location:unauth.php?page=login");
}
echo $_SESSION['user_data']['end'];
?>

Selamat datang <?php print_r($_SESSION)?>