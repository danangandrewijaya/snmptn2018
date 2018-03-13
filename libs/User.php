<?php
require_once "Koneksi.php";

class User extends Koneksi{		
	
	function select($id){
		$query = mysqli_query("SELECT ".$data." FROM user WHERE userid = '$id'");
		return $this->conn()->query;
	}
	
	function validasiUser($nama, $sandi){
		$result = mysqli_query($this->conn(), "SELECT * FROM user WHERE user = '$nama' AND passwd = '$sandi'");
        $user_data = mysqli_fetch_array($result, MYSQLI_BOTH);
		if(mysqli_num_rows($result) == 1){
            $_SESSION['isLogin'] = true;
            $_SESSION['user_data'] = $user_data;
		    return true;
		} else {
		    return false;
        }
	}
	
}