<?php

//Iniciar sesión y conexión

require_once 'includes/conexion.php';

//Recoger Datos del formulario

if (isset($_POST)) {
    
    //Borrar Error antiguo
    if (isset($_SESSION['error-login'])) {
        unset($_SESSION['error-login']);
    }
    
    //Recojo datos del formulario
    $email = ($_POST['email']);
    $password = $_POST['password'];

    //Consulta para comprobar las credenciales

    $sql = "SELECT * FROM usuarios WHERE email ='$email'";
    $login = mysqli_query($db, $sql);
    //Comprobar la contraseña

    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);

        //$password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);
        $verify = password_verify($password, $usuario['password']);

        if ($verify) {
            //Utilizar una sesion para guardar los datos del usuario logueando
            $_SESSION['usuario'] = $usuario;
        } else {
            //Si algo falla, enviar una sesion con el fallo
            $_SESSION['error-login'] = "Login incorrecto";
        }
    } else {
        $_SESSION['error-login'] = "Login incorrecto";
    }
}

//Redirigir al Index
header('Location: index.php');
