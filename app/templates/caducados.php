<?php ob_start() ?>               
                
                
                <!-- TARJETAS DE PRUEBA -->
				<div class="cards">
				<h3 class="titulo tit2"><?php echo $params['titulo'] ?></h3>
					<ul class="card_list" id="card_list">
						<?php if ($params['resultado'] == "No hay registros en esta tabla"): ?>
							<p>Aun no has añadido ningún alimento</p>
							<!--  -->
						<?php else: ?> <!-- si hay registros/imagenes -->

							<?php $contadordots=0;?>
							<?php foreach ($params['resultado'] as $alimento) :?>
								<?php if ($alimento['fecha_caducidad'])?>
								<?php $contadordots++;?>
								<?php 
									$fecha_cad = $alimento['fecha_caducidad'];
									$fecha_hoy = date("Y-m-d");
									$datetime1 = date_create($fecha_hoy);
									$datetime2 = date_create($fecha_cad);
									$interval = date_diff($datetime1, $datetime2); ?>

									<!-- si la fecha es negativa o 0 -->
									<?php if ($interval->format('%r%a días') <= 0): ?>
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
													<p class="info-nombre_alimento"><small><?php echo $alimento['nombre'] ?></small><br><?php echo $alimento['fecha_caducidad'] ?></p>
												</div>
											<!-- si la fecha es negativa y es 0 significa hoy-->
												<?php if($interval->format('%a días') == 0): ?>
													<div class="info-dias"><i class="fas fa-exclamation-triangle fa-fw" style="margin-right: 10px; color:#D32F2F;"></i><?php echo "Hoy" ?></div>
											<!-- si la fecha es negativa y es  significa ayer-->
												<?php elseif($interval->format('%a días') == 1): ?>
													<div class="info-dias">
														<i class="fas fa-exclamation-triangle fa-fw" style="margin-right: 10px; color:#D32F2F;"></i><?php echo "Ayer" ?> 
													</div>		
												<?php endif; ?>

												<div class="info-dias">
													<i class="fas fa-exclamation-triangle fa-fw" style="margin-right: 10px; color:#D32F2F;"></i>
													<?php echo $interval->format('%a días') ?>
												</div>
												<!-- three dots --><div class="dots" id="punto_<?php echo $contadordots; ?>"></div>
											</div>
										</li>
								<?php endif; ?> <!-- si fecha caducidad esta true (si no hay devuelve falso?) -->
							<?php endforeach; ?>  <!-- recorro los alimentos -->
						<?php endif; ?>  <!-- sino hay resultados o si si los hay -->

					</ul>
                </div>
                

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>