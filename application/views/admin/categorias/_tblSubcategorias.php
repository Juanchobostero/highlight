<table class="table table-hover">
	<thead>
		<tr>
			<th>Subcategoría</th>
			<th>Categoría</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($subcategorias as $subcategoria) : ?>
			<tr>
				<td><?= $subcategoria->descripcionSC; ?></td>
				<td><?= $subcategoria->descripcionCAT; ?></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerSubcategoria/' . $subcategoria->id_subcategoria) ?>', 'small', 'modal-small')">
							<i class="fas fa-eye"></i>
						</button>
						<button type="button" class="btn btn-warning" title="Editar" onclick="cargarForm('<?= base_url('frmEditarSubcategoria/' . $subcategoria->id_subcategoria) ?>', 'small', 'modal-small')">
							<i class="fas fa-pen text-white"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
