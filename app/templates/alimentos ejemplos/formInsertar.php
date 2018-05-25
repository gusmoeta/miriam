<?php ob_start() ?>


 <br/>
 <form name="formInsertar" action="index.php?ctl=insertar" method="POST">
     <table id="insertar">
         <tr>
             <th>Nombre: </th>
             <td>
               <input type="text" name="nombre" value="<?php echo $params['nombre'] ?>" autofocus />
             </td>
         </tr>
         <tr>
             <th>Energía (Kcal): </th>
             <td>
               <input type="text" name="energia" value="<?php echo $params['energia'] ?>" />
             </td>
         </tr>
         <tr>
             <th>Proteina (g): </th> 
             <td>               
               <input type="text" name="proteina" value="<?php echo $params['proteina'] ?>" />
             </td>
         </tr>
         <tr>
            <th>H. de carbono (g): </th>
             <td>
               <input type="text" name="hc" value="<?php echo $params['hc'] ?>" />
             </td>
         </tr>
         <tr>
             <th>Fibra (g): </th>
             <td>
               <input type="text" name="fibra" value="<?php echo $params['fibra'] ?>" />
             </td>
         </tr>
         <tr>
             <th>Grasa total (g): </th>
             <td>
               <input type="text" name="grasa" value="<?php echo $params['grasa'] ?>" />
             </td>
         </tr>

     </table>
     <input type="submit" value="insertar" name="insertar" /> <i>* Los valores deben referirse a 100 g del alimento</i>

 </form>
    <?php if(isset($params['mensaje'])) :?>
        <span><?php echo $params['mensaje'] ?></span>
    <?php endif; ?>
 

 <?php $contenido = ob_get_clean() ?>

 <?php include 'layout.php' ?>
