<?php
require_once ('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */
function userOk($login,$clave):bool {
    global $usuarios;
    $login_exist = false;
    
    if (array_key_exists($login,$usuarios)) $login_exist=true;


    return $login_exist && ($usuarios[$login][1] == $clave);
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login){
    global $usuarios;

    return $usuarios[$login][2];
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo):String{
    $msg="";
    $user="";
    global $nombreModulos;
    global $notas;
    global $usuarios;


    $msg .= " Bienvenido/a alumno/a: ". $usuarios[$codigo][0];
    $msg .= "<table>";
    $msg .= "<tr> <th>Módulo</th> <th>Nota</th> </tr>";

    for ($i=0; $i < count($nombreModulos); $i++) { 
        $msg .= "<tr> <td>$nombreModulos[$i]</td> <td>".$notas[$codigo][$i]."</td> </tr>";
    }

    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas ($codigo): String {
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    $msg .= " Bienvenido Profesor: ". $usuarios[$codigo][0];
    $msg .= "<table>";
        //Imprimir las cabeceras
        $msg .= "<tr><th>Nombre</th>";
        foreach ($nombreModulos as  $value) {
            $msg .= "<th>$value</th>";
        }
        $msg .= "</tr>";

        //Imprimir los valores
        foreach ($usuarios as $key => $value) {
            if ($usuarios[$key][2] != ROL_PROFESOR) {
                $msg .= "<tr><td>".$value[0]."</td>";
                for ($i=0; $i < count($notas)-1; $i++) { 
                    $msg .= "<td>".$notas[$key][$i]."</td>";
                }
                $msg .= "</tr>";
            }
        }
    $msg .= "</table>";
    return $msg;
}