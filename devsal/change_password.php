<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header('location: login.php');
    exit;
}

    
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/cosmo/bootstrap.min.css" rel="stylesheet" integrity="sha384-qdQEsAI45WFCO5QwXBelBe1rR9Nwiss4rGEqiszC+9olH1ScrLrMQr1KmDR964uZ" crossorigin="anonymous">
    <style type="text/css">
        .wrapper{ 
            width: 500px; 
            padding: 20px; 
        }
        .wrapper h2 {text-align: center}
        .wrapper form .form-group span {color: red;}
    </style>
</head>
<body>
    <main class="container wrapper">
        <section>
            <h2>Reset Password</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                    <label>New Password</label>
                    <input type="password" id="new_password" class="form-control"">
                    <span class="help-block"></span>
                </div>
                <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                    <label>Confirm Password</label>
                    <input type="password" id="confirm_password" class="form-control">
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <input type="button" class="btn btn-block btn-outline-success" value="Submit" id="changeP">
                    <a class="btn btn-block btn-link bg-light" href="index.php">Cancel</a>
                </div>
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
   $('#changeP').on("click", function() {

        var varUser = <?php $_SESSION["IdUsuario"]?>;
        var varPass = calcMD5($("#new_password").val()).toLowerCase();
     
        $.ajax({
            url: "modules/module.register.php",
            type: "POST",
            data: {user: varUser, pass: varPass, cmd: "change_password"},
            success: function (response) {
              if (response == 1) {
					alert("Se cambió correctamente");
                  	$(location).attr('href', './index.php');
                }else {
                    alert("No se pudo cambiar el password");
                } 
                
            }
        });

      });


    </script> 
</body>

</html>