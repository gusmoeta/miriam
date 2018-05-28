<?php ob_start() ?>               
                
                
                <!-- TARJETAS DE PRUEBA -->
				<div class="cards">
					<ul class="card_list" id="card_list">
						<li class="card_item rojo" id="draggable">
							<div class="card_info">
								<div class="info-alimento">
									<img class="info-foto" src="../web/images/galletas.jpg" alt="">
									<p class="info-nombre_alimento"><small>Galletas</small><br>19/05/2018</p>
                                </div>
                                
								<div class="info-dias"><i class="fas fa-exclamation-triangle fa-fw" style="margin-right: 10px; color:#D32F2F;"></i>Hace 2 semanas</div>
							</div>
						</li>
						<li class="card_item rojo" id="draggable">
							<div class="card_info">
								<div class="info-alimento">
									<img class="info-foto" src="../web/images/salmon.jpg" alt="">
									<p class="info-nombre_alimento"><small>Salmón</small><br>23/05/2018</p>
								</div>
								<div class="info-dias"><i class="fas fa-exclamation-triangle fa-fw" style="margin-right: 10px; color:#D32F2F;"></i>Ayer</div>
							</div>
						</li>
						<li class="card_item rojo" id="draggable">
							<div class="card_info">
								<div class="info-alimento">
									<img class="info-foto" src="../web/images/tomate.jpg" alt="">
									<p class="info-nombre_alimento"><small>Tomates</small><br>18/05/2018</p>
								</div>
								<div class="info-dias"><i class="fas fa-exclamation-triangle fa-fw" style="margin-right: 10px; color:#D32F2F;"></i>Hace 6 días</div>
							</div>
						</li>
						<?php if ($params['resultado'] == "No hay registros en esta tabla"): ?>
							<p>Aun no has añadido ningún alimento</p>
							<!--  -->
						<?php else: ?> <!-- si hay registros/imagenes -->
							<?php foreach ($params['resultado'] as $alimento) :?>
							<?php if ($alimento['fecha_caducidad'])?>
							<?php 
								$fecha_cad = $alimento['fecha_caducidad'];
								$fecha_hoy = date("Y-m-d");
								$datetime1 = date_create($fecha_hoy);
								$datetime2 = date_create($fecha_cad);
								$interval = date_diff($datetime1, $datetime2); ?>

								<?php if ($interval->format('%r%a días') <= 0): ?>
									<li class="card_item rojo" id="draggable">
										<div class="card_info">
											<div class="info-alimento">
												<img class="info-foto" src="<?php echo "../web/fotos/" . $alimento['foto'] ?>" alt="">
												<p class="info-nombre_alimento"><small><?php echo $alimento['nombre'] ?></small><br>18/05/2018</p>
											</div>
											<div class="info-dias"><i class="fas fa-exclamation-triangle fa-fw" style="margin-right: 10px; color:#D32F2F;"></i>Hace 6 días</div>
										</div>
									</li>
								<?php endif; ?>
							<?php endforeach; ?> 
						<?php endif; ?>

					</ul>
                </div>
                

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>