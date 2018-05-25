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

					</ul>
                </div>
                

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>