<?php ob_start() ?>

<div class="contenedor_perfil cards">
  <div class="container">
    <div class="img-container">
      <img src="../web/images/perfil_banner.png" alt="" class="banner-img">
        <img src="../web/images/usuario.png" alt="" class="profile-img">
    </div>
    
    <div class="content">
      <div class="title">
        <p><?php echo ucfirst($_SESSION['usuario']) ?></p>
      </div>
      <span class="error"><?php echo $error ?></span>
      <span class="success"><?php echo $success ?></span>
      <div class="follow"><button type="button" data-toggle="modal" data-target="#exampleModal">
      Cambiar contraseña
      </button></div>
      <div class="follow"><button type="button" data-toggle="modal" data-target="#exampleModal2">
      Cambiar email
      </button></div>
      <div class="follow eliminar"><form method="POST" action="index.php?ctl=eliminar_usuario" class="formu"><button type="submit" href="" id="eliminar_user">
      Eliminar usuario</form>
      </a></div>   
    </div>    
  </div>
</div>

<script>
  $(".fomu").validate(
		submitHandler: function() {
        swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Poof! Your imaginary file has been deleted!", {
            icon: "success",
          });
        } else {
          swal("Your imaginary file is safe!");
        }
      });
    }
  }
</script>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cambiar contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="contenedor_form">
          <div class="wrap_form">
            <form action="index.php?ctl=cambiar_contra" method="POST" class="formulario" name="formu">
              <div>
                <div class="input-group">
                  <input type="password" name="contra_actual" id="nombre_cat" placeholder="Tu contraseña antigua">
                </div>
                <div class="input-group">
                  <input type="password" name="contra_nueva1" id="nombre_cat" placeholder="Tu nueva contraseña">
                </div>
                <div class="input-group">
                  <input type="password" name="contra_nueva2" id="nombre_cat" placeholder="Repite contraseña">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-success" value="Guardar cambios" style="border-radius: .25rem"> <!--style="background-color:green"-->
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cambiar email</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="contenedor_form">
          <div class="wrap_form">
            <form action="index.php?ctl=cambiar_correo" method="POST" class="formulario" name="formu">
              <div>
                <div class="input-group">
                  <input type="email" name="email_actual" id="nombre_cat" placeholder="Tu email antiguo">
                </div>
                <div class="input-group">
                  <input type="email" name="email_nuevo" id="nombre_cat" placeholder="Tu nuevo email">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-success" value="Guardar cambios" style="border-radius: .25rem"> <!--style="background-color:green"-->
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 
