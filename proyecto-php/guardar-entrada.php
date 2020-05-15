<?php

if (isset($_POST)) {

    require_once 'includes/conexion.php';
    if (!isset($_SESSION)) {
        session_start();
    }

    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
    $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
    $usuario = isset($_SESSION['usuario']['id']) ? $_SESSION['usuario']['id'] : false;

    $errores = array();

    if (!empty($titulo) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $titulo_validado = true;
    } else {
        $titulo_validado = false;
        $errores['titulo'] = "El campo es inválido";
    }

    if (count($errores) == 0) {
        if (isset($_GET['editar'])) {
            $entrada_id = $_GET['editar'];
            $usuario_id = $_SESSION['usuario']['id'];
            $sql = "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id=$categoria " .
                    "WHERE id=$entrada_id AND usuario_id=$usuario_id";
        } else {
            $sql = "INSERT INTO entradas VALUES(NULL, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
        }
        $guardar = mysqli_query($db, $sql);
    } else {
        $_SESSION['errores_entrada'] = $errores;
    }
}

header("Location: index.php");