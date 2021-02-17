<table class="table table-sm table-hover">
	<thead>
		<tr class="text-center">
			<th>Código</th>
			<th>Producto</th>
			<th>Existencia</th>
			<th>Ver</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($productos as $producto) : ?>
			<tr>
				<td><?=$producto->codigoPR;?></td>
				<td><?=$producto->nombrePR;?></td>
				<td class="bg-danger text-center"><?=$producto->stockPR;?></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerProductoBajoStock/' . $producto->id_producto) ?>', 'extra-large', 'modal-extra-large')">
							<i class="fas fa-eye"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
