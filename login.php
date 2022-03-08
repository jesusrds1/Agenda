<?php
include_once('control_acceso.php');
include_once('db.php');
include_once('vista.php');

$db = conectar();
if($db==false){
    echo "Hubo problemas conectando";
}


$usuario = isset($_POST['usuario'])?$_POST['usuario']:"";
$password = isset($_POST['password'])?$_POST['password']:"";

$erroresValidacion = validarFormularioLogin($usuario,$password);

if(count($erroresValidacion)>0){
    pintarCabeceira();
    pintarFormularioLogin($_SERVER['PHP_SELF'],"POST",$usuario);
    foreach ($erroresValidacion as $error) {
        echo "<p>* $error </p>";
    }
    pintarPe();
}else if(!esUsuarioValido($db,$usuario, md5($password))){
    pintarCabeceira();
    pintarFormularioLogin($_SERVER['PHP_SELF'],"POST",$usuario);
    echo "<p> * El usuario o password facilitados no son válidos </p>";
    pintarPe();
}else{
    iniciarSesionUsuario($usuario);
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $index = 'index.php';
    header("Location: http://$host$uri/$index");  
}

if(!desconectar($db)){
    echo "Hubo problemas desconectando";
}


function validarFormularioLogin($u,$p){
    $errs = array();
    if($u == ""){
        array_push($errs, "El usuario no puede quedar vacío");
    }
    if(strlen($u)<4){
        array_push($errs, "El usuario tiene que tener al menos 4 caracteres");
    }
    if($p == ""){
        array_push($errs, "El password no puede quedar vacío");
    }
    if(strlen($p)<4){
        array_push($errs, "El campo pasword tiene que tener al menos dos caracteres");
    }

    return $errs;
}