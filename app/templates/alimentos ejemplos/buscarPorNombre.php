<?php ob_start() ?>

<form name="formBusqueda" action="index.php?ctl=buscar" method="POST">

  <table>
    <tr>
      <th>Nombre alimento: </th>
      <td>
        <input type="text" name="nombre" value="<?php echo $params['nombre']?>" id="nom_alimento" autofocus>
        <!--(puedes utilizar '%' como comodín)-->
      </td>
    </tr>
    <tr>
      <td>
        <input type="submit" value="buscar">
      </td>
      </tr>
  </table>

</form>

      <?php if (count($params['resultado'])>0): ?>
      <?php include 'tablaresultado.php' ?>
      <?php endif; ?>

      
      <?php $contenido = ob_get_clean() ?>



      <?php include 'layout.php' ?>
