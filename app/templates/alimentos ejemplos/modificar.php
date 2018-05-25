<form name="formInsertar" action="index.php?ctl=modificar" method="POST">
    <table id="modificar">
         <tr>
             <th>Alimento (por 100g) </th>
             <th>Energía (Kcal) </th>
             <th>Proteina (g) </th>
             <th>H. de carbono (g) </th>
             <th>Fibra (g)</th>
             <th>Grasa (g)</th>
             <!--<th>foto</th>-->
         </tr>
         <?php foreach ($params['resultado'] as $alimento) :?>
         <tr>
             <td><a href="index.php?ctl=ver&id=<?php echo $alimento['id']?>">
                 <?php echo $alimento['nombre'] ?></a></td>
             <td><input type="text" value="<?php echo $alimento['energia']?>" name="energia[<?php echo $alimento['id'] ?>]" size="3"></td>
             <td><input type="text" value="<?php echo $alimento['proteina']?>" name="proteina[<?php echo $alimento['id'] ?>]" size="3"></td>
             <td><input type="text" value="<?php echo $alimento['hidratocarbono']?>" name="hidratocarbono[<?php echo $alimento['id'] ?>]" size="3"></td>
             <td><input type="text" value="<?php echo $alimento['fibra']?>" name="fibra[<?php echo $alimento['id'] ?>]" size="3"></td>
             <td><input type="text" value="<?php echo $alimento['grasatotal']?>" name="grasatotal[<?php echo $alimento['id'] ?>]" size="3"></td>
             <!--<td><img src="<?php //echo "\alimentos\\fotos\\" . $alimento['foto']?>" id="imgalimento"></td>-->
         </tr>
         <?php endforeach; ?>
         <tr><td></td></tr>
     </table>
     <input type="submit" value="modificar" name="modificar">
</form>