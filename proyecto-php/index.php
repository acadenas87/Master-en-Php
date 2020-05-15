<?php require_once 'includes/cabecera.php'; ?>

<?php require_once 'includes/lateral.php'; ?>

<div id="principal">
    <div id="todas-las-entradas">
        <h1>Últimas entradas</h1>

        <?php
        $entradas = conseguirEntradas($db, true);

        if (!empty($entradas)) {

            while ($entrada = mysqli_fetch_assoc($entradas)) {
                echo "<article class='entrada'>"
                . "<a href='entrada.php?id=".$entrada['id']."'>"
                . "<h2>" . $entrada['titulo'] . "</h2>"
                . "<span class='fecha'>" . $entrada['categoria'] . " | " . $entrada['fecha'] . "</span>"
                . "<p>" . substr($entrada['descripcion'], 0, 180) . "</p>"
                . "</a>"
                . "</article>";
            }
        }
        ?>    
    </div>
    <div></br></div>
    <div id="ver-todas">
        <a href="entradas.php">Ver todas las entradas</a>
    </div>

</div>  
</div> <!-- Fin principal -->


<?php require_once 'includes/pie.php'; ?>