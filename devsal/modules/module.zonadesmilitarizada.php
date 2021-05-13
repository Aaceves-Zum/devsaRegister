<?php
$varUbicacion = 'securezone';
include_once("../class/class.conexion.mysql.php");
include_once("../class/class.sesiones.php");
session_start();

if(!empty($_POST)){
  $database = new dbmysql();
  extract($_REQUEST);
	switch($cmd){
		//---------------------------  Login  ---------------------------
    case "index":
    
			if(trim($user) != "" && trim($pass) != "") {
        $user = strtolower(htmlentities($user, ENT_QUOTES));
        
				 // SQL - Referencia de la consulta para extraer el password y compararlo según la variable del POST $password
         $usuario = $database->getRow("SELECT * FROM Usuarios WHERE User = ? ", [$user]); 
         
         if ($usuario != false) {
           if($usuario["Password"] == $pass) {

                if ($usuario["IdUsuario"]) {
                  Sessions::keySesionCreate($usuario["IdUsuario"]);

                  $_SESSION["IdUsuario"] = $usuario["IdUsuario"];
                  $_SESSION["UsuarioNombre"] = $usuario["Nombre"];
                  $_SESSION["UsuarioUser"] = $usuario["User"];
                  $_SESSION['loggedin'] = true;
                  
                  $data = array(
                    "us" => $usuario["IdUsuario"]
                );
                exit(json_encode($data));
               }else echo 0;
               
           } else echo 0; //"incorrect credentials";
         } else echo 0;//"incorrect credentials";
      }
    break;

    
  }

}


?>
 