<?php

class Koneksi{
	var $host		= "localhost";
	var $username	= "root";
	var $password	= "";
	var $db			= "snmptn-verifikasi";
	
	function conn() {
		$koneksi = mysqli_connect($this->host, $this->username, $this->password) or die("Gagal koneksi database! msg: ". mysqli_connect_error());
		$select_db = mysqli_select_db($koneksi, $this->db) or die("Database tidak ditemukan! msg: ". mysqli_error($koneksi));
		return $koneksi;
	}
	
	function query($request){
		return mysqli_query($this->conn(), $request);
	}
	
	function num_rows($request){
		return mysqli_num_rows(mysqli_query($this->conn(), $request));
	}
	
}