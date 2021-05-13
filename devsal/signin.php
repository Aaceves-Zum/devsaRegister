<?php
  include_once("class/class.conexion.mysql.php");
  session_start();

  $database = new dbmysql();

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
  }
  $username = $password = '';
  $username_err = $password_err = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty(trim($_POST['username']))){
      $username_err = 'Please enter username.';
    } else{
      $username = trim($_POST['username']);
    }

    if(empty(trim($_POST['password']))){
      $password_err = 'Please enter your password.';
    } else{
      $password = trim($_POST['password']);
    }

  }
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
      <h2 class="display-4 pt-3">Login</h2>
          <p class="text-center">Please fill this form to create an account.</p>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group <?php (!empty($username_err))?'has_error':'';?>">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" value="<?php echo $username ?>">
              <span class="help-block"><?php echo $username_err;?></span>
            </div>

            <div class="form-group <?php (!empty($password_err))?'has_error':'';?>">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" value="<?php echo $password ?>">
              <span class="help-block"><?php echo $password_err;?></span>
            </div>

            <div class="form-group">
              <input type="button" class="btn btn-block btn-outline-primary" id="login_boton" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign in</a>.</p>
          </form>
    </section>
  </main>
    <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

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