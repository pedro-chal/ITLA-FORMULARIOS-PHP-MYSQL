<?php

include('conexion.php');
$con = Conectar();
$error = "";
   
    if (!empty($_POST["usuario"])) {
        $usuario = $_POST["usuario"];
    }else{
        $error .= "Debe Ingresar Un Usuario <br>";
    }

    if (!empty($_POST["clave"])) {
        $pass = $_POST["clave"];
    }else{
        $error .= "Debe Ingresar Una Contraseña <br>";
    }
    
    if ($error == "") {
        try {
            $stmt = $con->prepare("SELECT * FROM tbl_users where usuario = '$usuario' and pass='$pass'");
            // $stmt = $con->prepare("CALL sp_consultUser(?,?)");
            // $stmt->bindParam(1,$usuario);
            // $stmt->bindParam(2,$pass);
            $stmt->execute();
            $datos = $stmt->FetchAll(PDO::FETCH_ASSOC);
            if (count($datos) > 0) {
                
                echo json_encode($datos);
            }else{
                $error .= "Usuario O Password Incorrecto";
                
            }
            
            
        } catch (\Throwable $th) {
            //throw $th;
            echo false;
        }
    
    }
    echo $error;
