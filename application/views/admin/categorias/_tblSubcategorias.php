<table class="table table-sm table-hover">
	<thead class="text-center">
		<tr>
			<th scope="col">Subcategoría</th>
			<th scope="col">Categoría</th>
			<th scope="col">Imágen</th>
			<th scope="col">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($subcategorias as $subcategoria) : ?>
			<tr>
				<td><?= $subcategoria->descripcionSC; ?></td>
				<td><?= $subcategoria->descripcionCAT; ?></td>
				<td>
					<img class="img-fluid m-auto d-block rounded" src="<?= base_url($subcategoria->imagenSC); ?>" style="object-fit: cover; min-height: 35px; max-width: 35px;">
				</td>
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
