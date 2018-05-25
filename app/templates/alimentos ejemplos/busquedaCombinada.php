<?php ob_start() ?>

      <form name="formBusqueda" action="index.php?ctl=busquedaCombinada" method="POST">

        <table id="buscar">
          <tr>
          <td><label>Energía alimento: </label> <input type="text" name="energia" value="<?php echo $params['energia']?>" autofocus size="3"></td>
          <td>            
          </td>

         
          </tr>

          <tr>
            <td>
              <label>Mostrar alimentos energía </label>
              <select name="opcion">
                <option value="igual">igual</option>
                <option value="mayor">mayor</option>
                <option value="menor">menor</option>
              </select>
              <label> a cantidad introducida</label>
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

