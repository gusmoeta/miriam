<?php ob_start() ?>

<div class="contenedor_perfil">
  <div class="container">
    <div class="img-container">
      <img src="../web/images/perfil_banner.png" alt="" class="banner-img">
        <img src="../web/images/usuario.png" alt="" class="profile-img">
      
      <!-- <div class="share">
        <ul>
          <li><i class="fa fa-twitter" aria-hidden="true"></i></li>
          <li><i class="fa fa-git" aria-hidden="true"></i></li>
          <li><i class="fa fa-linkedin" aria-hidden="true"></i></li>
        </ul>
      </div> -->
    </div>
    
    <div class="content">
      <div class="title">
        <p><?php echo ucfirst($_SESSION['usuario']) ?></p>
        <!-- <span>Cambiar contraseña</span><br>
        <span>Cambiar email</span> -->
      </div>
      
      <div class="follow">Cambiar contraseña</div><br>
      <div class="follow">Cambiar email</div>

      

    </div>    
  </div>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 
