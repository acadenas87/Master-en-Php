<?php require_once 'includes/redireccion.php'; ?>
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
        <h1>Edita la entrada de: <?= $entradaActual['titulo'] ?></h1>
        <p>
            Edita tu entrada.
        </p>
        </br>
        <form action='guardar-entrada.php?editar=<?= $entradaActual['id'] ?>' method='POST'>
            <label for='titulo'>Título:</label>
            <input type='text' name='titulo' required="required" value="<?= $entradaActual['titulo'] ?>"/>

            <label for='descripcion'>Descripción:</label>
            <textarea type='text' name='descripcion' required="required"><?= $entradaActual['descripcion'] ?></textarea>

            <label for='categoria'>Categoría</label>
            <select name='categoria'>
                <?php
                $categorias = conseguirCategorias($db);
                if (!empty($categorias)) {
                    while ($categoria = mysqli_fetch_assoc($categorias)) {
                        echo "<option value='" . $categoria['id'] . "'".($categoria['id'] == $entradaActual['categoria_id'] ? 'selected="selected"' : '').">" . $categoria['nombre'] . "</option>";
                    }
                }
                ?>
            </select>
            <input type='submit' value='Guardar' />
        </form>


    </div>
</div>  
</div> 











<?php require_once 'includes/pie.php'; ?>