<?php

include_once('db.php');
include_once('vista.php');

function validarFormulario($n,$a, $t, $c,$p){ //se queremos engadir por exemplo un movil añadiriamos un $m no validarformulario e validaremos con 2 if 
    $errs = array();
    if($n == ""){
        array_push($errs, "El nombre no puede quedar vacío");
    }
    if(strlen($n)<2){
        array_push($errs, "El nombre tiene que tener al menos dos caracteres");
    }
    if($a == ""){
        array_push($errs, "El campo apellidos no puede quedar vacío");
    }
    if(strlen($a)<2){
        array_push($errs, "El campo apellidos tiene que tener al menos dos caracteres");
    }
    if($t == ""){
        array_push($errs, "El teléfono no puede quedar vacío");
    }
    if(!filter_var($t,FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[0-9]{9}$/")))){
        array_push($errs, "El formato de teléfono no es válido");
    }
    if($c == ""){
        array_push($errs, "El correo no puede quedar vacío");
    }
    if(!filter_var($c,FILTER_VALIDATE_EMAIL)){
        array_push($errs, "El formato de teléfono no es válido");
    }
    if(strlen($p)<3){
        array_push($errs, "El campo persona tiene que tener al menos 4 caracteres");
    }
    if($p == ""){
        array_push($errs, "por favor,añade una persona");
    return $errs;
    }
}

$db = conectar();
if($db==false){
    echo "Hubo problemas conectando";
}


$nombre = isset($_POST['nombre'])?$_POST['nombre']:"";
$apellidos = isset($_POST['apellidos'])?$_POST['apellidos']:"";
$tel_fijo = isset($_POST['tel_fijo'])?$_POST['tel_fijo']:"";
$correo = isset($_POST['correo'])?$_POST['correo']:"";
$persona = isset($_POST['persona'])?$_POST['persona']:"";
// recoller o dato do movil por exemplo

$erroresValidacion = validarFormulario($nombre,$apellidos,$tel_fijo,$correo,$persona); //añadir movil
if(count($erroresValidacion)>0){
    pintarFormulario($_SERVER['PHP_SELF'],"POST",$nombre,$apellidos,$tel_fijo,$correo,$persona);
    foreach ($erroresValidacion as $error) {
        echo "<p>* $error </p>";
    }
}else{
    $resultado = insertarContacto($db,$nombre,$apellidos,$tel_fijo,$correo,$persona);
    if($resultado){
        if(!desconectar($db)){
            echo "Hubo problemas desconectando";
        }else{
            $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            $index = 'index.php';
            header("Location: http://$host$uri/$index");    
        }
    }else{
        echo "Hubo problemas al insertar el contacto";
    }
}



