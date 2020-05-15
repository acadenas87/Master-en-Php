<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id='principal'>
    <div id="todas-las-entradas">
        <h1>Mis datos</h1>

        <?php
        if (isset($_SESSION['completado'])) {
            echo "<div class='alerta'>" . $_SESSION['completado'] . '</div>';
        } else
        if (isset($_SESSION['errores']['general'])) {
            echo "<div class='alerta alerta-error'>" . $_SESSION['errores']['general'] . '</div>';
        }
        ?>
        <form action = "actualizar-usuario.php" method = "POST">
            <label for = "nombre">Nombre</label>
            <input type = "text" name = "nombre" required="required" pattern="[A-Za-z]+" value="<?= $_SESSION['usuario']['nombre']; ?>"/>
            <?php
            if (isset($_SESSION['errores'])) {
                echo mostrarError($_SESSION['errores'], 'nombre');
            } else {
                echo "";
            }
            ?>

            <label for = "apellidos">Apellidos</label>
            <input type = "text" name = "apellidos" required="required" pattern="([A-Z][a-z]*( [A-Z][a-z]*){0,10})$" value="<?= $_SESSION['usuario']['apellidos']; ?>"/>
            <?php
            if (isset($_SESSION['errores'])) {
                echo mostrarError($_SESSION['errores'], 'apellidos');
            } else {
                echo "";
            }
            ?>

            <label for = "email">Email</label>
            <input type = "email" name = "email" required="required" value="<?= $_SESSION['usuario']['email']; ?>"/>
            <?php
            if (isset($_SESSION['errores'])) {
                echo mostrarError($_SESSION['errores'], 'email');
            } else {
                echo "";
            }
            ?>


            <input type = "submit" value = "Actualizar" />
        </form>
        <?php borrarErrores() ?>
    </div>
</div>


</div> 
<?php require_once 'includes/pie.php'; ?>