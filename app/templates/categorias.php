<?php ob_start() ?>





			<div class="cards">
				<ul class="card_list" id="card_list">
					<!-- <li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
							<p class="info-nombre_categoria">Verduras de hoja verde</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
						<p class="info-nombre_categoria">Comida china</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
						<p class="info-nombre_categoria">Frutas</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
							<p class="info-nombre_categoria">Verduras de hoja verde</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
						<p class="info-nombre_categoria">Comida china</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
						<p class="info-nombre_categoria">Frutas</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
							<p class="info-nombre_categoria">Verduras de hoja verde</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
						<p class="info-nombre_categoria">Comida china</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
						<p class="info-nombre_categoria">Frutas</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
							<p class="info-nombre_categoria">Verduras de hoja verde con flor naranja</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
						<p class="info-nombre_categoria">Comida china</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
						<p class="info-nombre_categoria">Frutas</p>
						</div>
					</li>
					<li class="card_item_cat negro ui-widget-content" id="draggable">
						<div class="card_info_cat">
							<p class="info-nombre_categoria">Verduras de hoja verde</p>
						</div>
					</li> -->



					<?php if ($params['categorias'] == "No hay registros en esta tabla"): ?>
							<p>Aun no hay ninguna categoría</p>
							<!--  -->
						<?php else: ?> <!-- si hay registros/imagenes -->
							<?php foreach ($params['categorias'] as $categoria) :?>
							<li class="card_item_cat negro ui-widget-content" id="draggable">
							<div class="card_info_cat">
							<p class="info-nombre_categoria"><?php echo $categoria['nombre']?></p>
							</div>
							</li>
							<?php endforeach; ?>
					<?php endif; ?>		
				</ul>
			</div>
			<div class="contenedor_form">
				<div class="wrap_form">
					<form action="index.php?ctl=categorias" method="POST" class="formulario" name="formu">
						<div>
							<div class="input-group">
								<input type="text" name="nombre_cat" id="nombre_cat">
								<label class="label" for="nombre_cat">Nombre</label>
							</div>
							<div class="btn-input">
								<input type="submit" value="Añadir" name="btn_anadir_ali" id="btn_anadir_ali">
							</div
						</div>
					</form>
				</div>
			</div>
			

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>