<!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"> -->
				<?php foreach ($msjs_ult_tres as $msj) : ?>
					<a href="<?= base_url('admin/mensajes/nro-mensaje/' . $msj->id_mensaje); ?>" class="dropdown-item <?= ($msj->estado_mensaje == 0) ? 'unread' : ''; ?>">
						<!-- Message Start -->
						<div class="media">
							<div class="media-body single-line">
								<h3 class="dropdown-item-title">
									<?= $msj->nombre; ?>
								</h3>
								<p class="text-sm"><?= $msj->mensaje; ?></p>
								<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?= (date('Y-m-d') == date('Y-m-d', strtotime($msj->fecha_envio))) ? date('H:i', strtotime($msj->fecha_envio)) : date('d/m/Y', strtotime($msj->fecha_envio)); ?></p>
							</div>
						</div>
						<!-- Message End -->
					</a>
					<div class="dropdown-divider"></div>
				<?php endforeach; ?>
				<a href="<?= base_url('admin/mensajes'); ?>" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
			<!-- </div> -->
