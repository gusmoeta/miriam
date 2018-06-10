<?php ob_start(); //var_dump($_SESSION);?>

				<div class="cards">
				
					<div class="content-buscar2">
					<h3 class="titulo tit2"><?php echo $params['titulo'] ?></h3>
						<div class="input-group buscar2">
							<form action="index.php?ctl=buscar_alimento" method="POST">
								<input type="search" name="buscar" placeholder="Buscar alimento">
							</form>
						</div>
					</div>
					<ul class="card_list" id="card_list">


						<!-- TARJETAS DE DE LA BBDD -->
							<!-- si no hay registros/imagenes -->
						<?php if ($params['resultado'] == "No hay registros en esta tabla"): ?>
							<p>Aun no has añadido ningún alimento</p>
							<!--  -->
						<?php else: ?> <!-- si hay registros/imagenes -->
							<?php foreach ($params['resultado'] as $alimento) :?>
							<?php 
								  $fecha_congelado = $alimento['fecha_congelado'];	
								//   echo date('d/m/Y', strtotime($fecha_congelado));
								$fecha_cad = $alimento['fecha_caducidad'];
								//echo $fecha_cad;
								  $fecha_hoy = date("Y-m-d");
								  $datetime1 = date_create($fecha_hoy);
								  $datetime2 = date_create($fecha_cad);
								  $interval = date_diff($datetime1, $datetime2);
								//echo $interval->format('%r%a días'); ?>

								<!-- si diferencia negativa!, un formato -->
								<?php if ($interval->format('%r%a días')<0): ?>
									<li class="card_item rojo" id="draggable">
										<div class="card_info">
											<!-- three dot menu -->											
											<div class="dropdown">																						
												<!-- menu -->
												<div class="myDropdown dropdown-content">
													<a href="index.php?ctl=editar_alimento&id_ali=<?php echo $alimento['id'] ?>"><i class="fas fa-edit"style="margin-right: 15px"></i>Editar</a>
													<a href="index.php?ctl=eliminar_alimento&id_ali=<?php echo $alimento['id'] ?>"><i class="fas fa-trash" style="margin-right: 15px"></i>Eliminar</a>
												</div>
											</div>
											<div class="info-alimento">
												<img class="info-foto" src="<?php echo "../web/fotos/" . $alimento['foto'] ?>" alt="">
												<p class="info-nombre_alimento"><small><?php echo ucfirst($alimento['nombre']) ?></small><br><?php echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
											</div>
											<div class="info-dias"><i class="fas fa-exclamation-triangle fa-fw" style="margin-right: 10px; color:#D32F2F;"></i>  Hace <?php echo $interval->format('%a días'); ?></div>
											<!-- three dots --><div class="dots"></div>
										</div>
									</li>
								<!-- SI DIFERENCIA POSITIVA, OTRO FORMATO -->
								<?php else: ?>
									<!-- SI (POSITIVA) CADUCA EN DOS SEMANAS O MENOS, BORDE NARANJA -->
									<?php if ($interval->format('%r%a días') <= 14): ?>
											<!-- DOS SEMANAS O MENOS, BORDE NARANJA 3 POSIBLES TIPOS -->
											<?php switch (true): 									
														case $alimento['id_tipo'] == "4c919ada-5aa0-11e8-a54d-e0d55e08b86f": ?>
																<li class="card_item naranja" id="draggable">
																	<div class="card_info">
																		<!-- three dot menu -->											
																		<div class="dropdown">																						
																			<!-- menu -->
																			<div class="myDropdown dropdown-content">
																				<a href="index.php?ctl=editar_alimento&id_ali=<?php echo $alimento['id'] ?>">
																					<i class="fas fa-edit"style="margin-right: 15px"></i>
																					Editar
																				</a>
																				<a href="index.php?ctl=eliminar_alimento&id_ali=<?php echo $alimento['id'] ?>">
																					<i class="fas fa-trash" style="margin-right: 15px"></i>
																					Eliminar
																				</a>
																			</div>
																		</div>
																		<div class="info-alimento">
																			<img class="info-foto" src="<?php echo "../web/fotos/" . $alimento['foto'] ?>" alt="">
																			<p class="info-nombre_alimento"><small><?php echo ucfirst($alimento['nombre']) ?></small><br><?php echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
																		</div>
																		<div class="info-dias"><div class="tipoAzul"><img src="../web/images/tipos/tipo_nevera.ico" class="tipoImg"></div> Quedan <?php echo $interval->format('%a días'); ?></div>
																		<!-- three dots --><div class="dots"></div>
																	</div>
																</li>
												<?php	break; ?>
												<?php	case $alimento['id_tipo'] == "4c901697-5aa0-11e8-a54d-e0d55e08b86f": ?>
																<li class="card_item azul" id="draggable">
																	<div class="card_info">
																		<!-- three dot menu -->											
																		<div class="dropdown">																						
																			<!-- menu -->
																			<div class="myDropdown dropdown-content">
																				<a href="index.php?ctl=editar_alimento&id_ali=<?php echo $alimento['id'] ?>"><i class="fas fa-edit"style="margin-right: 15px"></i>Editar</a>
																				<a href="index.php?ctl=eliminar_alimento&id_ali=<?php echo $alimento['id'] ?>"><i class="fas fa-trash" style="margin-right: 15px"></i>Eliminar</a>
																			</div>
																		</div>
																			<div class="info-alimento">
																			<img class="info-foto" src="<?php echo "../web/fotos/" . $alimento['foto'] ?>" alt="">
																			<p class="info-nombre_alimento"><small><?php echo ucfirst($alimento['nombre']) ?></small><br><?php //echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
																		</div>
																		<div class="info-dias"><div class="tipoAzul"><img src="../web/images/tipos/tipo_congelado.ico" class="tipoImg"></div> <?php echo date('d/m/Y', strtotime($fecha_congelado)); ?></div>
																		<!-- three dots --><div class="dots"></div>
																	</div>
																</li>
												<?php	break; ?>
												<?php	case $alimento['id_tipo'] == "4c919b77-5aa0-11e8-a54d-e0d55e08b86f": ?>
														<li class="card_item naranja" id="draggable">
															<div class="card_info">
																<!-- three dot menu -->											
																<div class="dropdown">																						
																	<!-- menu -->
																	<div class="myDropdown dropdown-content">
																		<a href="index.php?ctl=editar_alimento&id_ali=<?php echo $alimento['id'] ?>">
																			<i class="fas fa-edit"style="margin-right: 15px"></i>
																			Editar
																		</a>
																		<a href="index.php?ctl=eliminar_alimento&id_ali=<?php echo $alimento['id'] ?>">
																			<i class="fas fa-trash" style="margin-right: 15px"></i>
																			Eliminar
																		</a>
																	</div>
																</div>
																<div class="info-alimento">
																	<img class="info-foto" src="<?php echo "../web/fotos/" . $alimento['foto'] ?>" alt="">
																	<p class="info-nombre_alimento"><small><?php echo ucfirst($alimento['nombre']) ?></small><br><?php echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
																</div>
																<div class="info-dias"><div class="tipoAzul"><img src="../web/images/tipos/tipo_despensa.ico" class="tipoImg"></div> Quedan <?php echo $interval->format('%a días'); ?></div>
																<!-- three dots --><div class="dots"></div>
															</div>
														</li>
												<?php	break; ?>
												<?php	default: ?>
															<!--  METER EL DEFAULT HTML -->

											<?php endswitch; ?>
									<?php endif; ?>
									
									<!-- si (positiva)caduca en mas de dos semanas, borde verde -->
									<?php if ($interval->format('%r%a días') > 14): ?>
									<!-- dos semanas o menos, borde naranja 3 posibles tipos -->
											<?php switch (true): 									
														case $alimento['id_tipo'] == "4c919ada-5aa0-11e8-a54d-e0d55e08b86f": ?>
																<li class="card_item verde" id="draggable">
																	<div class="card_info">
																		<!-- three dot menu -->											
																		<div class="dropdown">																						
																			<!-- menu -->
																			<div class="myDropdown dropdown-content">
																				<a href="index.php?ctl=editar_alimento&id_ali=<?php echo $alimento['id'] ?>">
																					<i class="fas fa-edit"style="margin-right: 15px"></i>
																					Editar
																				</a>
																				<a href="index.php?ctl=eliminar_alimento&id_ali=<?php echo $alimento['id'] ?>">
																					<i class="fas fa-trash" style="margin-right: 15px"></i>
																					Eliminar
																				</a>
																			</div>
																		</div>
																		<div class="info-alimento">
																			<img class="info-foto" src="<?php echo "../web/fotos/" . $alimento['foto'] ?>" alt="">
																			<p class="info-nombre_alimento"><small><?php echo ucfirst($alimento['nombre']) ?></small><br><?php echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
																		</div>
																		<div class="info-dias"><div class="tipoAzul"><img src="../web/images/tipos/tipo_nevera.ico" class="tipoImg"></div> Quedan <?php echo $interval->format('%a días'); ?></div>
																		<!-- three dots --><div class="dots"></div>
																	</div>
																</li>
												<?php	break; ?>
												<?php	case $alimento['id_tipo'] == "4c901697-5aa0-11e8-a54d-e0d55e08b86f": ?>
																<li class="card_item azul" id="draggable">
																	<div class="card_info">
																		<!-- three dot menu -->											
																		<div class="dropdown">																						
																			<!-- menu -->
																			<div class="myDropdown dropdown-content">
																				<a href="index.php?ctl=editar_alimento&id_ali=<?php echo $alimento['id'] ?>">
																					<i class="fas fa-edit"style="margin-right: 15px"></i>
																					Editar
																				</a>
																				<a href="index.php?ctl=eliminar_alimento&id_ali=<?php echo $alimento['id'] ?>">
																					<i class="fas fa-trash" style="margin-right: 15px"></i>
																					Eliminar
																				</a>
																			</div>
																		</div>
																		<div class="info-alimento">
																			<img class="info-foto" src="<?php echo "../web/fotos/" . $alimento['foto'] ?>" alt="">
																			<p class="info-nombre_alimento"><small><?php echo ucfirst($alimento['nombre']) ?></small><br><?php //echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
																		</div>
																		<div class="info-dias"><div class="tipoAzul"><img src="../web/images/tipos/tipo_congelado.ico" class="tipoImg"></div> <?php echo date('d/m/Y', strtotime($fecha_congelado)); ?></div>
																		<!-- three dots --><div class="dots"></div>
																	</div>
																</li>
												<?php	break; ?>
												<?php	case $alimento['id_tipo'] == "4c919b77-5aa0-11e8-a54d-e0d55e08b86f": ?>
														<li class="card_item verde" id="draggable">
															<div class="card_info">
																<!-- three dot menu -->											
																<div class="dropdown">																						
																	<!-- menu -->
																	<div class="myDropdown dropdown-content">
																		<a href="index.php?ctl=editar_alimento&id_ali=<?php echo $alimento['id'] ?>">
																			<i class="fas fa-edit"style="margin-right: 15px"></i>
																			Editar
																		</a>
																		<a href="index.php?ctl=eliminar_alimento&id_ali=<?php echo $alimento['id'] ?>">
																			<i class="fas fa-trash" style="margin-right: 15px"></i>
																			Eliminar
																		</a>
																	</div>
																</div>
																<div class="info-alimento">
																	<img class="info-foto" src="<?php echo "../web/fotos/" . $alimento['foto'] ?>" alt="">
																	<p class="info-nombre_alimento"><small><?php echo ucfirst($alimento['nombre']) ?></small><br><?php echo date("d/m/Y", strtotime($alimento['fecha_caducidad'])) ?></p>
																</div>
																<div class="info-dias"><div class="tipoAzul"><img src="../web/images/tipos/tipo_despensa.ico" class="tipoImg"></div> Quedan <?php echo $interval->format('%a días'); ?></div>
																<!-- three dots --><div class="dots"></div>
															</div>
														</li>
												<?php	break; ?>
												<?php	default: ?>
															<!--  METER EL DEFAULT HTML -->

											<?php endswitch; ?>
									<?php endif; ?>
								<?php endif; ?>	<!-- fin if si negativa la difffecha o nos -->							
							<?php endforeach; ?> <!-- fin impresion de tarjetas de la bbdd -->
						<?php endif; ?> <!-- fin if si no hay registros -->
					</ul><!-- fin ul -->
					<?php if (isset($_REQUEST['ctl'])): ?>
						<?php if ($_REQUEST['ctl'] == "buscar_alimento"): ?>
							<p style="font-size:12px; text-align:right">Se ha(n) encontrado <?php echo count($params['resultado']) ?> resultado(s)</p>
						<?php endif; ?>
					<?php endif; ?>
				</div> <!-- fin class card -->

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?> 



				<!-- TARJETAS DE PRUEBA -->
				<!-- <li class="card_item naranja" id="draggable"> ui-widget-content
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
				</li> -->
