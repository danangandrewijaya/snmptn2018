<?php
(!isset($_SESSION))?session_start():"";

class Core{
    
    var $base_url = "http://localhost/snmptn2018/";

    function getBaseUrl(){
        echo $this->base_url();
    }
	
	function setSession($var1, $var2, $var3){
		$_SESSION[$var1][$var2] = $var3;
	}
	
	function getAllSession(){
		return $_SESSION;
	}
	
	function getSession($var){
		return $_SESSION[$var];
	}
	
	function getSession2($var1, $var2){
		return $_SESSION[$var1][$var2];
	}
	
	function alertMsg($msg){
		return '<div style="color:red;">msg</div>';
	}
}