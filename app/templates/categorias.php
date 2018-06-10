<?php ob_start() ?>


			<div class="contenedor_form">
				<div class="wrap_form categoriasform">
				<h3 class="titulo tit2"><?php echo $params['titulo'] ?></h3>
					<form action="index.php?ctl=categorias" method="POST" class="formulario" name="formu">
						<div>
							<div class="input-group">
								<input type="text" name="nombre_cat" id="nombre_cat" placeholder="Añade una categoría">
							</div>
							<div class="btn-input">
								<input type="submit" value="Añadir" name="btn_anadir_ali" id="btn_anadir_ali">
						</div>
						</div>
					</form>
				</div>
			</div>


			<div class="cards">
				<ul class="card_list" id="card_list">
					<?php if ($params['categorias'] == "No hay registros en esta tabla"): ?>
							<p>Aun no hay ninguna categoría</p>
							<!--  -->
						<?php else: ?> <!-- si hay registros/imagenes -->
							<?php foreach ($params['categorias'] as $categoria) :?>
							<li class="card_item_cat negro ui-widget-content" id="draggable">
							<div class="card_info_cat">
							<p class="info-nombre_categoria"><?php echo ucfirst($categoria['nombre']) ?></p>
							</div>
							</li>
							<?php endforeach; ?>
					<?php endif; ?>		
				</ul>
			</div>

			

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>