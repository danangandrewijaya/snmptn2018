<?php
require_once "Koneksi.php";

class User extends Koneksi{		

	function add($nama, $sandi){
		$query = mysqli_query("INSERT INTO pengguna(nama, sandi) VALUES('$nama', '$sandi')");
		if($query){
			$msg = "Item berhasil ditambahkan!";
		} else {
			$msg = "Item gagal ditambahkan!";			
		}
		return $msg;
	}
	
	function select($id){
		$query = mysqli_query("SELECT ".$data." FROM user WHERE userid = '$id'");
		return $this->conn()->query;
	}
	
	function validasiUser($nama, $sandi){
		$result = false;
		$query = mysqli_query($this->conn(), "SELECT user, passwd FROM user WHERE user = '$nama' AND passwd = '$sandi'");
		if(mysqli_num_rows($query) > 0){
			$result = true;
		}
		return $result;
	}
	
}