<?php

if (isset($_POST)) {
    require_once 'includes/conexion.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    $usuario = $_SESSION['usuario'];
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
    $email = isset($_POST['email']) ? $_POST['email'] : false;

    $errores = array();

    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El campo es invÃ¡lido";
    }

    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "Los apellidos son invÃ¡lidos";
    }

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['email'] = "El email es invÃ¡lido";
    }

    $guardar_usuario = false;

    if (count($errores) == 0) {
        $guardar_usuario = true;

        //Comprobar si el email ya existe
        $sqlCheckIfEmailExists = "SELECT id, email FROM usuarios WHERE email = '$email'";

        $isset_email = mysqli_query($db, $sqlCheckIfEmailExists);
        $isset_user = mysqli_fetch_assoc($isset_email);

        /* var_dump($isset_user['id']);
          var_dump($usuario['id']);
          var_dump($email);
          die(); */

        if ($isset_user['id'] == $usuario['id'] || empty($isset_user)) {

            if (!($_SESSION['usuario']['nombre'] == $nombre && $_SESSION['usuario']['apellidos'] == $apellidos && $_SESSION['usuario']['email'] == $email)) {

                /* var_dump($_SESSION['usuario']['nombre']);
                  var_dump($nombre);
                  var_dump($_SESSION['usuario']['apellidos']);
                  var_dump($apellidos);
                  var_dump($_SESSION['usuario']['email']);
                  var_dump($email);
                  die(); */

                $sql = "UPDATE usuarios SET " . "nombre = '$nombre', " . "apellidos = '$apellidos', " . "email = '$email' " . "WHERE id = " . $usuario['id'];
                $guardar = mysqli_query($db, $sql);

                if ($guardar) {
                    $_SESSION['usuario']['nombre'] = $nombre;
                    $_SESSION['usuario']['apellidos'] = $apellidos;
                    $_SESSION['usuario']['email'] = $email;

                    $_SESSION['completado'] = "Se han actualizado los datos.";
                } else {
                    $_SESSION['errores']['general'] = "Fallo al actualizar los datos!";
                }
            } else {
                $_SESSION['errores']['general'] = "No se ha hecho ningún cambio!";
            }
        } else {
            $_SESSION['errores']['general'] = "El usuario ya existe";
        }
    } else {
        $_SESSION['errores'] = $errores;
        header('Location: index.php');
    }
}

header('Location: mis-datos.php');
