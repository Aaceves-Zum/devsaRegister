<?php
class Sessions{
	//Validar Sesión
	static function validarUsuario(){
		if(Sessions::verificarSesion()){
			$id_usuario = $_SESSION["IdUsuario"];
		}else{
			Sessions::redireclogin();
		}
	}

	//En caso de tener la sesión activa lo envia al panel principal del sistema
	static function validarlogin(){
		if(Sessions::verificarSesion()){
			echo '<script languaje="javascript">location.href = "./dashboard.php";</script>';
		}
	}

	//Verifica la sesión del usuario
	static function verificarSesion(){
		//session_start();
		if(isset($_SESSION['keysession'])){
			$createKey = Sessions::keySesionCreate($_SESSION["IdUsuario"]);
			if($_SESSION['keysession'] == $createKey){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	//Cierra la sesión del usuario
	static function cerrarSesion() {
		if(isset($_SESSION["IdUsuario"])){
			session_destroy();
			return true;
		}else{
			return false;
		}

	}

	//En caso de no tener la sesión activa lo envia a la página de login
	static function redireclogin(){
     	echo '<script languaje="javascript">location.href = "./index.php";</script>';
	}

	//Funcion llave para validar la sesión valida
	static function keySesionCreate($UsuarioID){

		$today = date('Ymd');
		$llavePrivada = "31953195";
		if(isset($UsuarioID)){
			$_SESSION['keysession'] = sha1($UsuarioID.$today.$llavePrivada);
		}else{
			$_SESSION['keysession'] = 0;
		}
		return $_SESSION['keysession'];

	}


	static function validateType($TipoUsuario,$location){
		//$permisos = json_decode($_SESSION["DistribuidorPermisos"]);;
		switch($TipoUsuario){

			//USUARIO MANAGER
			case '1':
				echo ( ($location=="dashboard") || ($location=="promotores") || ($location=="clientes") ) ? "":"<script languaje='javascript'>location.href = '/index';</script>";
				
			break;

			case '2':
				echo ( ($location=="promotores") ) ? "":"<script languaje='javascript'>location.href = '/index';</script>";
				
			break;

			case '3':
				echo ( ($location=="clientes") ) ? "":"<script languaje='javascript'>location.href = '/index';</script>";
				
			break;

		
		}
	}
	
}
?>
