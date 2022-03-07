<?php

function pintarCabeceira(){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de contactos</title>
</head>
<body>
    <h1>Agenda de contactos</h1>
<?php
}


function pintarPe(){
?>
    <footer>Feito no Aller Ulloa no 2022</footer>
    
    </body>
    </html>
<?php
}


function mostrarContactos($contactos){
    $cabeceraTabla = false;
    for ($i=0; $i<count($contactos); $i++) {
        if(!$cabeceraTabla){
            $cabeceraTabla = array_keys($contactos[$i]);
            echo "<table border='1'><tr>";
            foreach ($cabeceraTabla as $nombreColumna) {
                echo "<th> $nombreColumna </th>";
            }
            echo "</tr>";
            
        }
        echo "<tr>";
        foreach ($contactos[$i] as $nombreCampo => $valorCampo) {
            echo "<td> $valorCampo </td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}


function pintarFormulario($action,$method,$nombre,$apellidos,$tel_fijo,$correo){
    ?>

    <form action = "<?php echo $action;?>" method="<?php echo $method?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $nombre?>" required><br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="<?php echo $apellidos?>" required><br>
        <label for="tel_fijo">Teléfono fijo:</label>
        <input type="text" name="tel_fijo" value="<?php echo $tel_fijo?>" required><br>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="<?php echo $correo?>" required><br>

        <input type="submit" value="Enviar">
    </form>

    <?php
}

?>