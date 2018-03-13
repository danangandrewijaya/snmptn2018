<?php
	(!isset($_SESSION))?session_start():"";
	if(isset($_POST['submit'])){
		$user = new User;
		if($user->validasiUser($_POST['nama'], md5($_POST['sandi']))){
//			$core->setSession('Login', 'username', $_POST['nama']);
//			$core->setSession('Login', 'isLogin', true);
//			$tes = $user->select('start');
//			$core->setSession('Login', 'start', $tes);
            
            
			header("location:index.php");
		} else {
			echo "Nama user atau sandi tidak benar";
		}
	}
?>
<h2>Login</h2>
<form action="unauth.php?page=login" method="post">
	<table border="0">
		<tr>
			<td>
				Nama User:
			</td>
			<td>
				<input type="text" name="nama" autocomplete="off" />
			</td>
		</tr>
		<tr>
			<td>
				Sandi:
			</td>
			<td>
				<input type="password" name="sandi" />
			</td>			
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td>
				<input type="submit" name="submit" value="MASUK" />
			</td>
		</tr>
	</table>
</form>
