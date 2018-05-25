<?php ob_start() ?>

				<!-- TARJETAS DE PRUEBA -->
				<div class="cards">
					<ul class="card_list" id="card_list">
						<li class="card_item naranja" id="draggable"> <!--ui-widget-content-->
							<div class="card_info">
								<div class="info-alimento">
									<img class="info-foto" src="../web/images/galletas.jpg" alt="">
									<p class="info-nombre_alimento"><small>Galletas</small><br>19/05/2018</p>
								</div>
								<div class="info-dias">7 días</div>
							</div>
						</li>
						<li class="card_item azulclaro" id="draggable">
							<div class="card_info">
								<div class="info-alimento">
									<img class="info-foto" src="../web/images/salmon.jpg" alt="">
									<p class="info-nombre_alimento"><small>Salmón</small><br>23/05/2018</p>
								</div>
								<div class="info-dias">10 días</div>
							</div>
						</li>
						<li class="card_item azul" id="draggable">
							<div class="card_info">
								<div class="info-alimento">
									<img class="info-foto" src="../web/images/tomate.jpg" alt="">
									<p class="info-nombre_alimento"><small>Tomates</small><br>18/05/2018</p>
								</div>
								<div class="info-dias">6 días</div>
							</div>
						</li>

						<!-- TARJETAS DE DE LA BBDD -->
							<!-- si no hay registros/imagenes -->
						<?php if ($params['resultado'] == "No hay registros en esta tabla"): ?>
							<p>Aun no has añadido ningún alimento</p>
							<!--  -->
						<?php else: ?> <!-- si hay registros/imagenes -->
							<?php foreach ($params['resultado'] as $alimento) :?>
							<?php $fecha_cad = $alimento['fecha_caducidad'];
								  $fecha_hoy = date("Y-m-d");
								  $datetime1 = date_create($fecha_hoy);
								  $datetime2 = date_create($fecha_cad);
								  $interval = date_diff($datetime1, $datetime2);
								//echo $interval->format('%r%a días'); ?>
								<!-- si diferencia negativa!, un formato -->
								<?php if ($interval->format('%r%a días')<0): ?>
									<li class="card_item rojo" id="draggable">
										<div class="card_info">
											<div class="info-alimento">
												<img class="info-foto" src="<?php echo "../web/" . $alimento['foto'] ?>" alt="">
												<p class="info-nombre_alimento"><small><?php echo $alimento['nombre'] ?></small><br><?php echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
											</div>
											<div class="info-dias"><i class="fas fa-exclamation-triangle fa-fw" style="margin-right: 10px; color:#D32F2F;"></i>Hace <?php echo $interval->format('%a días'); ?></div>
										</div>
									</li>
									<!-- si diferencia positiva, otro formato -->
								<?php else: ?>
									<!-- si es de tipo nevera, un formato -->
									<?php if ($alimento['id_tipo'] == "4c919ada-5aa0-11e8-a54d-e0d55e08b86f"): ?>
										<li class="card_item azul" id="draggable">
											<div class="card_info">
												<div class="info-alimento">
													<img class="info-foto" src="<?php echo "../web/" . $alimento['foto'] ?>" alt="">
													<p class="info-nombre_alimento"><small><?php echo $alimento['nombre'] ?></small><br><?php echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
												</div>
												<div class="info-dias">Quedan <?php echo $interval->format('%a días'); ?></div>
											</div>
										</li>
										<!-- si es de tipo congelado -->
									<?php elseif ($alimento['id_tipo'] == "4c901697-5aa0-11e8-a54d-e0d55e08b86f"): ?>
										<li class="card_item azulclaro" id="draggable">
											<div class="card_info">
												<div class="info-alimento">
													<img class="info-foto" src="<?php echo "../web/" . $alimento['foto'] ?>" alt="">
													<p class="info-nombre_alimento"><small><?php echo $alimento['nombre'] ?></small><br><?php echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
												</div>
												<div class="info-dias">Quedan <?php echo $interval->format('%a días'); ?></div>
											</div>
										</li>
										<!-- si es de tipo despensa -->
									<?php elseif ($alimento['id_tipo'] == "4c919b77-5aa0-11e8-a54d-e0d55e08b86f"): ?>
										<li class="card_item naranja" id="draggable">
											<div class="card_info">
												<div class="info-alimento">
													<img class="info-foto" src="<?php echo "../web/" . $alimento['foto'] ?>" alt="">
													<p class="info-nombre_alimento"><small><?php echo $alimento['nombre'] ?></small><br><?php echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
												</div>
												<div class="info-dias">Quedan <?php echo $interval->format('%a días'); ?></div>
											</div>
										</li>
										<?php endif; ?>  <!-- fin if de tipo -->
									
								<?php endif; ?>	<!-- fin if si negativa la difffecha o nos -->							
							<?php endforeach; ?> <!-- fin impresion de tarjetas de la bbdd -->
						<?php endif; ?> <!-- fin if si no hay registros -->
					</ul><!-- fin ul -->
					
				</div> <!-- fin class card -->

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 
