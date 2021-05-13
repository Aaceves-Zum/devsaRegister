<?php
	$username = $password = $confirm_password = "";

	$username_err = $password_err = $confirm_password_err = "";
	


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign in</title>
	<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
	<style>
        .wrapper{ 
        	width: 500px; 
        	padding: 20px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}
	</style>
</head>
<body>
	<main>
		<section class="container wrapper">
			<h2 class="display-4 pt-3">Sign Up</h2>
        	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
				
				<div class="form-group <?php (!empty($confirm_password_err))?'has_error':'';?>">
        			<label for="confirm_password">Nombre</label>
        			<input type="text" name="nombre" id="nombreus" class="form-control">
        			<span class="help-block"><?php echo $confirm_password_err;?></span>
        		</div>

        		<div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
        			<label for="username">Username</label>
        			<input type="text" name="username" id="username" class="form-control" >
        			<span class="help-block"><?php echo $username_err;?></span>
        		</div>

        		<div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
        			<label for="password">Password</label>
        			<input type="password" name="password" id="password" class="form-control" >
        			<span class="help-block"><?php echo $password_err; ?></span>
        		</div>

        		<div class="form-group">
        			<input type="button" class="btn btn-block btn-outline-success" value="Register" id="register_id">
        			<input type="reset" class="btn btn-block btn-outline-primary" value="Reset">
        		</div>
        		<p>Already have an account? <a href="index.php">Login here</a>.</p>
        	</form>
		</section>
	</main>

	<script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/md5.js"></script>
  <script src="js/js.cookie.js"></script>

    <script>
    var btnRegister = $("#register_id");
    $('#register_id').on("click", function() {
        var varUser = $("#username").val();
        var varPass = calcMD5($("#password").val()).toLowerCase();
		var varNombre = $("#nombreus").val();
     
        $.ajax({
            url: "modules/module.register.php",
            type: "POST",
            data: {user: varUser, pass: varPass, cmd: "signin", varNombre},
            success: function (response) {
              if (response == 1) {
					alert("Se registró correctamente");
                  	$(location).attr('href', './index.php');
                }else {
                    alert("No se pudo registrar el usuario");
                } 
                
            }
        });

      });


    </script>
</body>
</html>