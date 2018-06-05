<?php ob_start(); ?>


			<div class="contenedor_form">
				<div class="wrap_form">				
					<form action="index.php?ctl=filtrarDatos" method="POST" class="formulario" name="formu">
						<div>
							<div class="input-group">
								<select name="categoria" id="categoria">
									<option value="">Selecciona una categoría</option>
									<?php foreach ($params['categorias'] as $categoria) :?>
											<option value="<?php echo $categoria['id'] ?>"><?php echo ucfirst($categoria['nombre']) ?></option>
									<?php endforeach; ?>	
								</select>
								<label class="label" for="categoria">Categoria</label>
							</div>
							<div class="input-group">
								<select name="tipo" id="tipo">
									<option value="">Selecciona un tipo</option>
									<?php foreach ($params['tipos'] as $tipo) :?>
											<option value="<?php echo $tipo['id'] ?>"><?php echo ucfirst($tipo['nombre']) ?></option>
									<?php endforeach; ?>
								</select>
								<label class="label" for="tipo">Tipo</label>
							</div>
							<div class="input-group">
								<input type="date" name="fecha_ini" id="fecha_ini">
								<label class="label" for="fecha_ini">Seleccione una fecha</label>
							</div>
							<div class="input-group">
								<input type="date" name="fecha_fin" id="fecha_fin">
								<label class="label" for="fecha_fin">O ambas, para buscar en un rango</label>
							</div>
							<!-- name="btn_anadir_ali" -->
							<div class="btn-input">
								<input type="submit" value="Buscar"  id="btn_anadir_ali">
							</div>
						</div>
					</form>
				</div>
			</div>





<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>