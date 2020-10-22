<table class="table table-hover projects">
	<thead>
		<tr>
			<th>Usuario</th>
			<th>Teléfono</th>
			<th>E-mail</th>
			<th>Foto</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($usuarios as $user) : ?>
			<tr>
				<td><?= $user->apellidoU; ?>, <?= $user->nombreU ?></td>
				<td><?= $user->telefonoU; ?></td>
				<td><?= $user->emailU; ?></td>
				<td>
					<img alt="Avatar" class="table-avatar" src="<?= base_url($user->fotoU); ?>">
				</td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerCliente/' . $user->id_usuario) ?>', 'small', 'modal-small')">
						<i class="fas fa-eye"></i>
						</button>
						<button type="button" class="btn btn-danger" title="Inhabilitar" onclick="eliminar(this, 'eliminarCliente/<?=$user->id_usuario;?>')">
						<i class="fas fa-thumbs-down"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
