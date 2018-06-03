<?php ob_start() ?>


			<div class="contenedor_form">
				<div class="wrap_form">
					<form action="index.php?ctl=editar_alimento" method="POST" class="formulario" name="formu" enctype="multipart/form-data">
						<div>
							<div class="input-group">
								<input type="text" name="nombre_ali" id="nombre_ali" value="<?php echo $params['alimento'][0]['nombre']?>" placeholder="Nombre del alimento" autofocus>
								<label class="label" for="nombre_ali">Nombre</label>
							</div>
							<div class="input-group">
								<select name="categoria" id="categoria" required>
									<?php foreach ($params['categorias'] as $categoria): ?>
										<?php if ($categoria['id'] == $params['alimento'][0]['id_categoria']): ?>
											<option value="<?php echo $categoria['id']; ?>" selected><?php echo ucfirst($categoria['nombre']); ?></option>
										<?php elseif($categoria['id'] != $params['alimento'][0]['id_categoria']): ?>
											<option value="<?php echo $categoria['id']; ?>"><?php echo ucfirst($categoria['nombre']); ?></option>
										<?php endif; ?>
									<?php endforeach; ?>								    
								</select>
								<label class="label" for="categoria">Categoria</label>
							</div>
							<div class="input-group">
								<select name="tipo" id="tipo" required>
								<?php foreach ($params['tipos'] as $tipo): ?>
										<?php if ($tipo['id'] == $params['alimento'][0]['id_tipo']): ?>
											<option value="<?php echo $tipo['id']; ?>" selected><?php echo ucfirst($tipo['nombre']); ?></option>
										<?php elseif($categoria['id'] != $params['alimento'][0]['id_tipo']): ?>
											<option value="<?php echo $tipo['id']; ?>"><?php echo ucfirst($tipo['nombre']); ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
								<label class="label" for="tipo">Tipo</label>
							</div>
							<div class="input-group fcongediv">
								<input type="date" name="fecha_con" id="fecha_con" value="<?php echo $params['alimento'][0]['fecha_congelado']?>">
								<label class="label" for="fecha_con">Fecha de congelado</label>
							</div>
							<div class="input-group fcaddiv">
								<input type="date" name="fecha_cad" id="fecha_cad" value="<?php echo $params['alimento'][0]['fecha_caducidad']?>" required>
								<label class="label" for="fecha_cad">Fecha de caducidad</label>
							</div>
							<div class="input-group">
								<input type="file" name="imagen_ali" id="imagen_ali" style="color: grey">
								<img class="foto" style="height:50px; width:50px; border-radius:50px; margin-left: 15px;" src="../web/fotos/<?php echo $params['alimento'][0]['foto']?>" alt="">

								<label class="label" for="imagen_ali">Selecciona una imagen</label>
							</div>
							<!-- <div class="btn-input"  id="demo-success"> -->
							<div class="btn-input">
								<input type="hidden" value="<?php echo $params['alimento'][0]['id']?>" name="id_ali">
								<input type="hidden" value="<?php echo $params['alimento'][0]['foto']?>" name="imagen">
								<input type="submit" value="Modificar" name="btn_anadir_ali"> 
								<!-- id="btn_anadir_ali"  -->
							</div>
						</div>
					</form>
					<script>
						// $(".formulario").validate({
						// 	submitHandler: 
						// 			notify({
						// 					type: "success", //alert | success | error | warning | info
						// 					title: "Success",
						// 					position: {
						// 						x: "right", //right | left | center
						// 						y: "top" //top | bottom | center
						// 					},
						// 					icon: '<img src="../web/toaster/images/success.png" />',
						// 					message: "Se ha modificado el alimento correctamente.",
						// 					autoHide: true, //true | false
						// 					delay: 4000 //number ms
						// 			})
						// 	}
						// );						
					</script>
				</div>
			</div>


<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>