<table class="table table-hover">
	<thead>
		<tr class="text-center">
			<th>Remitente</th>
			<th>Asunto - Mensaje</th>
			<th>Fecha</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($mensajes as $msj) : ?>
			<tr class="<?= ($msj->estado_mensaje == 0) ? 'unread' : ''; ?>" onclick="document.location = '<?= base_url('admin/mensajes/nro-mensaje/' . $msj->id_mensaje) ?>';" style="cursor:pointer">
				<td class="mailbox-name"><?= $msj->nombre; ?></td>
				<td class="mailbox-subject single-line">
					<p class="mb-0"><?= $msj->motivo; ?> - <small class="text-muted"><?= $msj->mensaje; ?></small></p>
				</td>
				<td class="mailbox-date"><small><?= (date('Y-m-d') == date('Y-m-d', strtotime($msj->fecha_envio))) ? date('H:i', strtotime($msj->fecha_envio)) : date('d/m/Y', strtotime($msj->fecha_envio)); ?></small></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<div class="mt-3 mb-2 text-center small">
	<span class="mr-2">
		<i class="fas fa-circle" style="color: #c5c5c5"></i> Nuevos
	</span>
</div>
