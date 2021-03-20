<table id="tbldeshabilitados" class="table table-sm table-hover">
	<thead>
		<tr>
			<th>Cliente</th>
			<th>Teléfono</th>
			<th>E-mail</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($clientes as $client) : ?>
			<tr>
				<td><?= $client->apellidoU; ?>, <?= $client->nombreU ?></td>
				<td><?= $client->telefonoU; ?></td>
				<td><?= $client->emailU; ?></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerCliente/' . $client->id_usuario) ?>', 'small', 'modal-small')">
						<i class="fas fa-eye"></i>
						</button>
						<button type="button" class="btn btn-success" title="Habilitar" onclick="habilitar(this, 'habDesCliente/<?=$client->id_usuario;?>')">
						<i class="fas fa-thumbs-up"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
