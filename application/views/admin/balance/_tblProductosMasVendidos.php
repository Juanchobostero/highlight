<table id="tblproductos-mas-vendidos" class="table table-sm table-hover">
	<thead>
		<tr class="text-center">
			<th>Código</th>
			<th>Producto</th>
			<th>Cantidad</th>
			<th>Ver</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($productos as $producto) : ?>
			<tr>
				<td><?= $producto->codigoPR; ?></td>
				<td><?= $producto->nombrePR; ?></td>
				<td class="text-center"><?= number_format($producto->cantidad, 0, ',', '.'); ?></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerProducto/' . $producto->id_producto) ?>', 'extra-large', 'modal-extra-large')">
							<i class="fas fa-eye"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
