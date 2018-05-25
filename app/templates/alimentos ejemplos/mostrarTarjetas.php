<?php ob_start() ?>

<?php include 'tablaresultado.php' ?>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
