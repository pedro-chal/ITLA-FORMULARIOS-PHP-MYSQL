<?php
include('conexion.php');

$con = Conectar();
$error = "";
if (!empty($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
}else{
    $error .= "Debe Ingresar un Nombre <br>";
}

if (!empty($_POST['apellido'])) {
    $apellido = $_POST['apellido'];
}else{
    $error .= "Debe Ingresar un Apellido <br>";
}

if (!empty($_POST['usuario'])) {
    $usuario = $_POST['usuario'];
}else{
    $error .= "Debe Ingresar un Usuario <br>";
}

if (!empty($_POST['password'])) {
    $pass = $_POST['password'];
}else{
    $error .= "Debe Ingresar un Password <br>";
}

if (!empty($_POST['sexo'])) {
    $sexo = $_POST['sexo'];
}else{
    $error .= "Debe Ingresar el Sexo <br>";
}
$pais = $_POST['pais'];
if ($error == "") {
    try {
        //code...
        $stmt = $con->prepare("call sp_addUser(?,?,?,?,?,?)");
    $stmt->bindParam(1,$nombre);
    $stmt->bindParam(2,$apellido);
    $stmt->bindParam(3,$usuario);
    $stmt->bindParam(4,$pass);
    $stmt->bindParam(5,$sexo);
    $stmt->bindParam(6,$pais);
    $stmt->execute();
    
    echo true;
    } catch (\Throwable $th) {
        //throw $th;
        echo false;
    }
}else{
    echo $error;
}


