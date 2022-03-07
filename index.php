<?php

include_once('db.php');
include_once('vista.php');

$db = conectar();
if($db==false){
    echo "Hubo problemas conectando";
}

$contactos = listarContactos($db);
pintarCabeceira();
mostrarContactos($contactos);
pintarPe();

echo "<a href='agregar_contacto.php'>Agregar contacto</a>";

if(!desconectar($db)){
    echo "Hubo problemas desconectando";
}