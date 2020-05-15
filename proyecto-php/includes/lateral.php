<?php require_once 'includes/helpers.php' ?>
<aside id = "sidebar">

    <div id = "buscador" class = "bloque">
        <h3>Buscar por Título</h3>

        <form action = "buscar.php" method = "POST">
            <input type = "text" name = "busqueda" />
            <input type = "submit" value = "Buscar Título" />
        </form>
    </div>

    <?php
    if (isset($_SESSION['usuario'])) {
        echo
        "<div id = 'usuario-logueado' class = 'bloque bloque-usuario'>
        <h3>Bienvenido: " . $_SESSION['usuario']['nombre'] . " " . $_SESSION['usuario']['apellidos'] . "</h3>" .
        "<a href='crear-entrada.php' class='boton boton-lila'>Crear Entrada</a>" .
        "<a href='crear-categoria.php' class='boton boton-verde'>Crear Categoría</a>" .
        "<a href='mis-datos.php' class='boton boton-naranja'>Mis Datos</a>" .
        "<a href='cerrar.php' class='boton boton-rojo'>Cerrar Sesión</a></div>";
    }
    ?>

    <?php if (!isset($_SESSION['usuario'])) { ?>
        <div id = "login" class = "bloque">
            <h3>Indentifícate</h3>
            <?php
            if (isset($_SESSION['error-login'])) {
                echo "<div class = 'alerta alerta-error'>"
                . $_SESSION['error-login'] . "</h3></div>";
            }
            ?>
            <form action = "login.php" method = "POST">
                <label for = "email">Email</label>
                <input type = "text" name = "email" />

                <label for = "password">Contraseña</label>
                <input type = "password" name = "password" />

                <input type = "submit" value = "Entrar" />
            </form>
        </div>

        <div id = "register" class = "bloque">
            <h3>Regístrate</h3>

            <!-- Mostrar Errores-->
            <?php
            if (isset($_SESSION['completado'])) {
                echo "<div class='alerta'>" . $_SESSION['completado'] . '</div>';
            } else
            if (isset($_SESSION['errores']['general'])) {
                echo "<div class='alerta alerta-error'>" . $_SESSION['errores']['general'] . '</div>';
            }
            ?>
            <form action = "registro.php" method = "POST">
                <label for = "nombre">Nombre</label>
                <input type = "text" name = "nombre" required="required" pattern="[A-Za-z]+"/>
                <?php
                if (isset($_SESSION['errores'])) {
                    echo mostrarError($_SESSION['errores'], 'nombre');
                } else {
                    echo "";
                }
                ?>
                <label for = "apellidos">Apellidos</label>
                <input type = "text" name = "apellidos" required="required" pattern="([A-Z][a-z]*( [A-Z][a-z]*){0,10})$"/>
                <?php
                if (isset($_SESSION['errores'])) {
                    echo mostrarError($_SESSION['errores'], 'apellidos');
                } else {
                    echo "";
                }
                ?>
                <label for = "email">Email</label>
                <input type = "email" name = "email" required="required"/>
                <?php
                if (isset($_SESSION['errores'])) {
                    echo mostrarError($_SESSION['errores'], 'email');
                } else {
                    echo "";
                }
                ?>
                <label for = "password">Contraseña</label>
                <input type = "password" name = "password" required="required"/>
                <?php
                if (isset($_SESSION['errores'])) {
                    echo mostrarError($_SESSION['errores'], 'password');
                } else {
                    echo "";
                }
                ?>


                <input type = "submit" value = "Registrar" />
            </form>
            <?php borrarErrores() ?>
        </div>
    <?php } ?>

</aside>