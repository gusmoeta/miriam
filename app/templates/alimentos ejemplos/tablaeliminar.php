<form method="POST" action="index.php?ctl=eliminar" onsubmit="return confirmar();">
    <table id="eliminar">
         <tr>
             <th>alimento (por 100g)</th>
             <th>energía (Kcal)</th>
             <th>grasa (g)</th>
         </tr>
         <?php foreach ($params['resultado'] as $alimento) :?>
         <tr>
             <td><a href="index.php?ctl=ver&id=<?php echo $alimento['id']?>">
                     <?php echo $alimento['nombre'] ?></a></td>
             <td><?php echo $alimento['energia']?></td>
             <td><?php echo $alimento['grasatotal']?></td>
             <td><input type="checkbox" name="id[]" value="<?php echo $alimento['id']?>"></td>
         </tr>
         <?php endforeach; ?>
         <tr><td colspan="4"></td></tr>
    </table>
    <input type="submit" name="" value="eliminar">
    <?php if(isset($params['mensaje'])) :?>
        <span><?php echo $params['mensaje'] ?></span>
    <?php endif; ?>
</form>