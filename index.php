<?php
session_start();
$intentos = 0;

if (isset($_SESSION['intentos'])) {
  $intentos = $_SESSION['intentos'];
}
$intentos++;

$_SESSION['intentos'] = $intentos;

if ($_SESSION['intentos'] > 5) {
  include_once 'app/accesoDenegado.php';
  exit();
}

include_once('app/funciones.php');

if (  !empty( $_GET['login']) && !empty($_GET['clave'])){
    if ( userOk($_GET['login'],$_GET['clave'])){
      if ( getUserRol($_GET['login']) == ROL_PROFESOR){
        $contenido = verNotaTodas($_GET['login']);
      } else {
        $contenido = verNotasAlumno($_GET['login']);
      }
      include_once ('app/resultado.php');
    } 
    // userOK falso
    else {
       $contenido = "El número de usuario y la contraseña no son válidos";
       include_once('app/acceso.php');
    }
} else {
    $contenido = " Introduzca su número de usuario y su contraseña";
    include_once('app/acceso.php');
}


