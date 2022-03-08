<?php
session_name("agenda");
session_start();

function comprobarSesionUsuario(){
    if(!isset($_SESSION['usuario'])){
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $index = 'login.php';
        header("Location: http://$host$uri/$index");
    }
}

function iniciarSesionUsuario($usuario){
    $_SESSION['usuario'] = $usuario;
}

function cerrarSesionUsuario(){
    $_SESSION = array();

    // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
    // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalmente, destruir la sesión.
    session_destroy();

    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $index = 'login.php';
    header("Location: http://$host$uri/$index");
}