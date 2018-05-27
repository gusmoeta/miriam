<?php ob_start(); ?>

<!-- Volver a template filtrar -->
<form action="index.php" method="get">
    <input type="hidden" name="filtrar">    
    <input type="submit" value="Volver">
</form>

<?php
$_REQUEST.length

?>




<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>