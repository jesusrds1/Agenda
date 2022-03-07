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

if(!desconectar($db)){
    echo "Hubo problemas desconectando";
}