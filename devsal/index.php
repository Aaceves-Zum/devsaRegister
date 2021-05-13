<?php
	// Initialize session
	session_start();

	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] !== false) {
		header('location: signin.php');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
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
			<div class="page-header">
				<h2 class="display-5">Bienvenido <?php echo $_SESSION["UsuarioNombre"]; ?></h2>
			</div>

			<a href="change_password.php" class="btn btn-block btn-outline-warning">Reset Password</a>
			<a href="logout.php" class="btn btn-block btn-outline-danger">Sign Out</a>
		</section>
	</main>

	  <!-- Bootstrap core JavaScript-->
	  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script src="js/md5.js"></script>
  <script src="js/js.cookie.js"></script>

    <script >
    var btnLogin = $("#login_boton");
    $('#login_boton').on("click", function() {
        var varUser = $("#username").val();
        var varPass = calcMD5($("#password").val()).toLowerCase(); // Password encriptado MD5
     
        $.ajax({
            beforeSend: function() {
                btnLogin.html('<i class="fa fa-spin fa-spinner"></i> Procesando...').prop("disabled", true).css("opacity", 0.5);
            },
            url: "modules/module.zonadesmilitarizada.php",
            type: "POST",
            data: {user: varUser, pass: varPass, cmd: "index"},
            success: function (response) {
              var respuesta = JSON.parse(response);
                if (respuesta.us != 0) {
                  <?php $_SESSION["loggedin"] = true ?>
                  $(location).attr('href', './index.php?a='+response.us);
                } else if (response==0) {
                    alert("Credenciales incorrectas");
                } 
                
                btnLogin.html('Iniciar sesión').prop("disabled", false).css("opacity", 1);

            }
        });
      });


    </script>
</body>
</html>