<?php ob_start() ?>


			<div class="contenedor_form">
				<div class="wrap_form">
					<form action="" method="POST" class="formulario" name="formu">
						<div>
							<div class="input-group">
								<select name="categoria" id="categoria">
									<option selected>Selecciona una categoría</option>
								</select>
								<label class="label" for="categoria">Categoria</label>
							</div>
							<div class="input-group">
								<select name="tipo" id="tipo">
									<option selected>Selecciona un tipo</option>
								</select>
								<label class="label" for="tipo">Tipo</label>
							</div>
							<div class="input-group">
								<input type="date" name="fecha_cad" id="fecha_cad">
								<label class="label" for="fecha_cad">Seleccione una fecha</label>
							</div>
							<div class="input-group">
								<input type="date" name="fecha_cad" id="fecha_cad">
								<label class="label" for="fecha_cad">O ambas, para buscar en un rango</label>
							</div>
							<div class="btn-input">
								<input type="submit" value="Buscar" name="btn_anadir_ali" id="btn_anadir_ali">
							</div
						</div>
					</form>
				</div>
			</div>





<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>