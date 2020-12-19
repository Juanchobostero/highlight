<table id="tbl-port-activa" class="table table-hover">
	<thead>
		<tr>
			<th>Título</th>
			<th>Publicado</th>
			<th>Imagen</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($portadas as $port) : ?>
			<tr>
				<td><?= $port->titulo; ?></td>
				<td class="text-center">
					<input type="checkbox" name="publicar" <?= ($port->publicado == 'SI') ? 'checked' : '' ?> data-bootstrap-switch data-off-text="NO" data-on-text="SI" data-off-color="danger" onchange="manejoSwitch(this, <?= $port->id_port; ?>, '<?=base_url('publicarPort')?>')">
				</td>
				<td>
					<img class="img-fluid m-auto d-block rounded" src="<?= base_url($port->imagen); ?>" style="width: 40px; height: 40px">
				</td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-warning" title="Editar" onclick="cargarForm('<?= base_url('frmEditarPortada/' . $port->id_port) ?>', 'small', 'modal-small')">
							<i class="fas fa-pen text-white"></i>
						</button>
						<button type="button" class="btn btn-danger" title="Eliminar" onclick="deshabilitar(this, 'eliminarPort/<?= $port->id_port; ?>')">
							<i class="fas fa-trash-alt"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
