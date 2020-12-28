<table class="table table-sm table-hover display">
	<thead class="text-center">
		<tr>
			<th>Marca</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($marcas as $marca) : ?>
			<tr>
				<td><?= $marca->descripcionM; ?></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerMarca/' . $marca->id_marca) ?>', 'small', 'modal-small')">
							<i class="fas fa-eye"></i>
						</button>
						<button type="button" class="btn btn-warning" title="Editar" onclick="cargarForm('<?= base_url('frmEditarMarca/' . $marca->id_marca) ?>', 'small', 'modal-small')">
							<i class="fas fa-pen text-white"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
