<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <div id="todas-las-entradas">
        <h1>Crear entradas</h1>
        <p>
            Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido.
        </p> 
        </br>
        <form action='guardar-entrada.php' method='POST'>
            <label for='titulo'>Título:</label>
            <input type='text' name='titulo' required="required"/>

            <label for='descripcion'>Descripción:</label>
            <textarea type='text' name='descripcion' required="required" pattern="[A-Za-z ]+"></textarea>

            <label for='categoria'>Categoría</label>
            <select name='categoria'>
                <?php
                $categorias = conseguirCategorias($db);
                if (!empty($categorias)) {
                    while ($categoria = mysqli_fetch_assoc($categorias)) {
                        echo "<option value='". $categoria['id']. "'>".$categoria['nombre']."</option>";
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
