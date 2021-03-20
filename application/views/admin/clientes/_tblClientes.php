<table id="tblactivos" class="table table-sm table-hover">
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
						<button type="button" class="btn btn-warning" title="Editar" onclick="cargarForm('<?= base_url('frmEditarCliente/' . $client->id_usuario) ?>', 'small', 'modal-small')">
						<i class="fas fa-pen text-white"></i>
						</button>
						<button type="button" class="btn btn-danger" title="Inhabilitar" onclick="deshabilitar(this, 'habDesCliente/<?=$client->id_usuario;?>')">
						<i class="fas fa-thumbs-down"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
