<?php ob_start() ?>
<?php //if(session_status() !== PHP_SESSION_ACTIVE){ session_start(); }?> 	
<div>
	<h2>CADUCALIA</h2><img src="../web/images/icon.png">
</div>
	<div class="tabs">
		<ul class="tabs">
			<li class="current">
				<a href="#">Log In</a>
			</li>
			<li class="">
				<a href="#">Registro</a>
			</li>
		</ul>
		    
			<!-- FORM INICIO DE SESIÓN -->
			<div class="wrap_form_sesion">
				<form action="comprobarUserFunction.php" method="POST" class="formulario" name="formu">
					<div>
						<div class="input-group">
							<input type="text" name="usuario" id="usuario" autofocus>
							<label class="label" for="usuario">Nombre o Email</label>
						</div>
						<div class="input-group">
							<input type="password" name="contra" id="contra">
							<label class="label" for="contra">Contraseña</label>
						</div>
						<input type="submit" value="Enviar" name="btn_sesion" id="btn_sesion">
					</div>
				</form>
			</div>
			<!-- FORM REGISTRO -->
			<div class="wrap_form_registro">
				<form action="index.php?ctl=registro" method="POST" class="formulario" name="formu">
					<div>
						<div class="input-group">
							<input type="text" name="nombre" id="nombre">
							<label class="label" for="nombre">Nombre</label>
						</div>
						<div class="input-group">
							<input type="email" name="email" id="email">
							<label class="label" for="email">Email</label>
						</div>
						<div class="input-group">
							<input type="password" name="pass" id="pass">
							<label class="label" for="pass">Contraseña</label>
						</div>
						<div class="input-group">
							<input type="password" name="passr" id="passr">
							<label class="label" for="passr">Repite la contraseña</label>
						</div>
						<input type="submit" value="Enviar" name="btn_registro" id="btn_registro">
					</div>
				</form>
			</div>
			<div class="social-login">
				<a href="#">
				<i class="fab fa-google-plus-square fa-lg"></i>
					Entrar con Google
				</a>
			</div>
	</div>

	<span class="error"><?php echo $mensaje ?></span>

</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layoutSesion.php' ?> 