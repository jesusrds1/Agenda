<?php

define('SERVIDOR', 'localhost');
define('USUARIO', 'agenda');
define('PASSWORD', 'abc123.');
define('DB', 'agenda');



function conectar(){
    $conexionBD = @mysqli_connect(SERVIDOR, USUARIO, PASSWORD, DB);

	if (!$conexionBD) {
		echo('Erro número ' . mysqli_connect_errno() . ' ao establecer a conexión: ' . mysqli_connect_error() . '.<br/>');
        return false;
	} 

    return $conexionBD;
}

function desconectar($conexionBD){
    if (!@mysqli_close($conexionBD)) {
        echo('Erro número ' . mysqli_errno($conexionBD) . ' ao pechar a conexión: ' . mysqli_error($conexionBD) . '.<br/>');
        return false;
    }
    return true;
}

function listarContactos($conexionBD){
    $sentenzaSQL = 'select * from contacto';
    $result = mysqli_query($conexionBD, $sentenzaSQL);

    if (!$result) {
        echo('Error en la consulta a la base de datos: ' . mysqli_error($conexionBD));
        return false;
    }

    return mysqli_fetch_all($result,MYSQLI_ASSOC);
}

function insertarContacto($conexionBD,$nombre,$apellidos,$tel_fijo,$correo){
    $sentenzaSQL = "INSERT INTO contacto (nombre, apellidos, tel_fijo, correo) VALUES ('$nombre', '$apellidos', '$tel_fijo', '$correo');";
    $result = mysqli_query($conexionBD, $sentenzaSQL);

    if (!$result) {
        echo('Error en la consulta a la base de datos: ' . mysqli_error($conexionBD));
        return false;
    }

    return true;
}

function esUsuarioValido($conexionBD,$usuario, $password){
    $sentenzaSQL = "select usuario,password from usuario where usuario='$usuario' and password='$password';";
    $result = mysqli_query($conexionBD, $sentenzaSQL);

    if (!$result) {
        echo('Error en la consulta a la base de datos: ' . mysqli_error($conexionBD));
        return false;
    }

    if(count(mysqli_fetch_all($result))>0){
        return true;
    }

    return false;
}

?>