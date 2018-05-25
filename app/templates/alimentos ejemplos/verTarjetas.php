<?php ob_start() ?>

 <h2><?php echo $params['nombre'] ?></h2>
 <table border="1" id="tablalimentos">

     <tr>
         <th>Energía: </th>
         <td><?php echo $alimento['energia'] ?></td>
         <td rowspan="5"><img src="\alimentos\fotos\<?php echo "" . $alimento['foto']?>" id="verimg"></td>         
     </tr>
     <tr>
         <th>Proteina: </th>
         <td><?php echo $alimento['proteina']?></td>

     </tr>
     <tr>
         <th>Carbohidratos: </th>
         <td><?php echo $alimento['hidratocarbono']?></td>

     </tr>
     <tr>
         <th>Fibra: </th>
         <td><?php echo $alimento['fibra']?></td>

     </tr>
     <tr>
         <th>Grasa total: </th>
         <td><?php echo $alimento['grasatotal']?></td>

     </tr>
     <tr><th colspan="3"><center>Receta: </center></th></tr>
     <tr><td colspan="3"><video src="\alimentos\videos\<?php echo $alimento['video']?>" controls width="350" height=""></video></td></tr>
 </table>

<!--<iframe width="350" height="300" src="<?php echo $alimento['video']?>?controls=0">
</iframe>-->
<div id="video">
   
</div>
<div id="clear"></div>
 <?php $contenido = ob_get_clean() ?>

 <?php include 'layout.php' ?>
