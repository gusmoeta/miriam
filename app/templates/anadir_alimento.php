<?php ob_start() ?>
			<div class="contenedor_form">
				<div class="wrap_form">
				<h3 class="titulo tit2"><?php echo $params['titulo'] ?></h3>
					<form action="index.php?ctl=anadir_alimento" method="POST" class="formulario" name="formu" enctype="multipart/form-data">
						<div>
							<div class="input-group">
								<input type="text" name="nombre_ali" id="nombre_ali" value="" placeholder="Nombre del alimento" autofocus>
								<label class="label" for="nombre_ali">Nombre</label>
							</div>
							<div class="input-group">
								<select name="categoria" id="categoria" required>
									<option value="">Selecciona una Categoría</option>										
									<?php foreach ($params['categorias'] as $categoria) :?>
											<option value="<?php echo $categoria['id'] ?>"><?php echo ucfirst($categoria['nombre']) ?></option>
									<?php endforeach; ?>								    
								</select>
								<label class="label" for="categoria">Categoria</label>
							</div>
							<div class="input-group">
								<select name="tipo" id="tipo" required>
									<option value="">Selecciona un tipo</option>								
									<?php foreach ($params['tipos'] as $tipo) :?>
											<option value="<?php echo $tipo['id'] ?>"><?php echo ucfirst($tipo['nombre']) ?></option>
									<?php endforeach; ?>
								</select>
								<label class="label" for="tipo">Tipo</label>
							</div>
							<div class="input-group fcongediv">
								<input type="date" name="fecha_con" id="fecha_con" value="">
								<label class="label" for="fecha_con">Fecha de congelado</label>
							</div>
							<div class="input-group fcaddiv">
								<input type="date" name="fecha_cad" id="fecha_cad" value="" required>
								<label class="label" for="fecha_cad">Fecha de caducidad</label>
							</div>
							<div class="input-group">
								<input type="file" name="imagen_ali" id="imagen_ali"  style="color: #757575" required>
								<label class="label" for="imagen_ali">Selecciona una imagen</label>
							</div>
							<!-- <div class="btn-input"  id="demo-success"> -->
							<div class="btn-input">
								<input type="submit" value="Añadir" name="btn_anadir_ali"> 
								<!-- id="btn_anadir_ali"  -->
							</div>
						</div>
					</form>
					<!-- <script>
					$(".formulario").validate(
						submitHandler: function() {
								alert("submitted!");
								notify({
										type: "success", //alert | success | error | warning | info
										title: "Success",
										position: {
											x: "right", //right | left | center
											y: "top" //top | bottom | center
										},
										icon: '<img src="../../web/toaster/images/success.png" />',
										message: "Se ha añadido el alimento correctamente.",
										autoHide: true, //true | false
										delay: 4000 //number ms
								});
					});
					</script> -->
				</div>
			</div>


<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>