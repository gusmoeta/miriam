<?php ob_start() ?>





			<div class="cards">
				<ul class="card_list" id="card_list">
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
				</ul>
			</div>
			<div class="contenedor_form">
				<div class="wrap_form">
					<form action="" method="POST" class="formulario" name="formu">
						<div>
							<div class="input-group">
								<input type="text" name="nombre_ali" id="nombre_ali">
								<label class="label" for="nombre_ali">Nombre</label>
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