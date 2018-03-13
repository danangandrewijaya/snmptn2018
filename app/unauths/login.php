<?php
	(!isset($_SESSION))?session_start():"";
    $salah = '';
	if(isset($_POST['submit'])){
		$user = new User;
		if($user->validasiUser($_POST['nama'], md5($_POST['sandi']))){          
			header("location:index.php");
		} else {
			$salah = '<p class="form-error">Nama user atau sandi tidak benar</p>';
		}
	}
?>
<div class="row">          
    <div class="col-md-4 col-md-offset-4">             
        <div class="login-panel panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title" style="text-align:center;font-size:24px;">Sign In</h3>
            </div>
            <div class="panel-body">
                <form action="unauth.php?page=login" method="post">
                    <fieldset>
                      <?php echo $salah?>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                            <input class="form-control" name="nama" type="username" placeholder="Username" autofocus>

                        </div>

                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
                            <input class="form-control" name="sandi" type="password" placeholder="Password" value="">

                        </div>

                        <input class="btn btn-lg btn-success btn-block" type="submit" value="Login" name="submit" >
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
