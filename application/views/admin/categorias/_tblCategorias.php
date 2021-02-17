<table class="table table-sm table-hover">
	<thead class="text-center">
		<tr>
			<th scope="col">Categoría</th>
			<th scope="col">Imágen</th>
			<th scope="col">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categorias as $categoria) : ?>
			<tr>
				<td><?= $categoria->descripcionCAT; ?></td>
				<td>
					<img class="img-fluid m-auto d-block rounded" src="<?= base_url($categoria->imagenCAT); ?>" style="object-fit: cover; min-height: 35px; max-width: 35px;">
				</td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerCategoria/' . $categoria->id_categoria) ?>', 'small', 'modal-small')">
							<i class="fas fa-eye"></i>
						</button>
						<button type="button" class="btn btn-warning" title="Editar" onclick="cargarForm('<?= base_url('frmEditarCategoria/' . $categoria->id_categoria) ?>', 'small', 'modal-small')">
							<i class="fas fa-pen text-white"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
