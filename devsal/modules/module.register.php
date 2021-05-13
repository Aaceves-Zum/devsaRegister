<?php

include_once("../class/class.conexion.mysql.php");
error_reporting(E_ALL);

if (!empty($_POST)) {

    extract($_REQUEST);
    switch($cmd){

        case 'signin':
            $database = new dbmysql();
            $ObtenUser = $database->getRow("SELECT IdUsuario FROM usuarios WHERE User = "."'".$user."'");

            if ($ObtenUser) {
                echo "El usuario ya existe";
            }else{
                $query = "INSERT INTO usuarios (User, Password, Nombre) VALUES (?,?,?)";
                print_r($database);
                $InsertUser = $database->insertRow($query,[ $user,$pass,$varNombre]);
                if ($InsertUser) {
                    echo 1;
                }else echo 2;
            }

            $database->Disconnect();
        break;

        case 'change_password':
            $database = new dbmysql();
            $ChangePassUser = $database->updateRow("UPDATE usuarios SET Password = ? WHERE IdUsuario = ?");

            if ($ChangePassUser) {
                echo 1;
            }else{
                echo 0;
            }

            $database->Disconnect();
        break;
    }
}