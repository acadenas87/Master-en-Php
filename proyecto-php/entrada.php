<?php require_once 'includes/cabecera.php'; ?>
<?php
$entradaActual = conseguirEntrada($db, $_GET['id']);
if (!isset($entradaActual['id'])) {
    header("Location: index.php");
}
?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <div id="todas-las-entradas">

        <h1><?= $entradaActual['titulo'] ?></h1>
        <a href="categoria.php?id=<?= $entradaActual['categoria_id'] ?>">
            <h2><?= $entradaActual['categoria']; ?> </h2></a>
        <h4>Autor: <?= $entradaActual['usuario']; ?> | <?= $entradaActual['fecha']; ?></h4>
        <p><?= $entradaActual['descripcion']; ?> </p>


    </div>

    <div></br></div>

    <?php
    if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entradaActual['usuario_id']) {
        echo "<div id='ver-todas'>" .
        "<a href = 'editar-entrada.php?id=" . $entradaActual['id'] . "' class = 'boton boton-verde'>Editar entrada</a><br/>" .
        "<a href = 'borrar-entrada.php?id=" . $entradaActual['id'] . "' class = 'boton boton-naranja'>Eliminar entrada</a>" .
        "</div>";
    }
    ?>
</div>  
</div> <!-- Fin principal -->


<?php require_once 'includes/pie.php'; ?>