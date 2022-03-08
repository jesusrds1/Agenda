<?php
include_once('control_acceso.php');
include_once('db.php');
include_once('vista.php');

comprobarSesionUsuario();

$db = conectar();
if($db==false){
    echo "Hubo problemas conectando";
}

$contactos = listarContactos($db);
pintarCabeceira();
mostrarContactos($contactos);
pintarPe();

echo "<p><a href='agregar_contacto.php'>Agregar contacto</a></p>";
echo "<p><a href='logout.php'>Salir</a></p>";

if(!desconectar($db)){
    echo "Hubo problemas desconectando";
}