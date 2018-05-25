<table id="mostrar">
     <tr>
         <th>alimento (por 100g)</th>
         <th>energía (Kcal)</th>
         <th>grasa (g)</th>
         <th>foto</th>
     </tr>
     <?php foreach ($params['resultado'] as $alimento) :?>
     <tr>
         <td><a href="index.php?ctl=ver&id=<?php echo $alimento['id']?>">
             <?php echo $alimento['nombre'] ?></a></td>
         <td><?php echo $alimento['energia']?></td>
         <td><?php echo $alimento['grasatotal']?></td>
         <td><img src="\alimentos\fotos\<?php echo $alimento['foto']?>" id="imgalimento"></td>
     </tr>
     <?php endforeach; ?>

 </table>
