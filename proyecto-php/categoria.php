<?php require_once 'includes/cabecera.php'; ?>
<?php
$categoriaActual = conseguirCategoria($db, $_GET['id']);
if (!isset($categoriaActual['id'])) {
    header("Location: index.php");
}
?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <div id="todas-las-entradas">

        <h1>Entradas de <?= $categoriaActual['nombre'] ?></h1>

        <?php
        $entradas = conseguirEntradas($db, null, $_GET['id']);

        if (!empty($entradas) && mysqli_num_rows($entradas) >= 1) {

            while ($entrada = mysqli_fetch_assoc($entradas)) {
                echo "<article class='entrada'>"
                . "<a href='entrada.php?id=".$entrada['id']."'>"
                . "<h2>" . $entrada['titulo'] . "</h2>"
                . "<span class='fecha'>" . $entrada['categoria'] . " | " . $entrada['fecha'] . "</span>"
                . "<p>" . substr($entrada['descripcion'], 0, 180) . "</p>"
                . "</a>"
                . "</article>";
            }
        } else {
            echo "<div class='alerta-error'>No hay entradas en esta categoría</div>";
        }
        ?>    
    </div>
    <div></br></div>

</div>  
</div> <!-- Fin principal -->


<?php require_once 'includes/pie.php'; ?>