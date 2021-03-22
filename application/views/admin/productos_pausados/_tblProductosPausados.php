<table id="tblProductosPausados" class="table table-sm table-hover">
	<thead>
		<tr>
			<th>Código</th>
			<th>Producto</th>
			<th>Marca</th>
			<th>Subcategoría</th>
			<th>Categoría</th>
			<th>Quitar</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($productos_pausados as $producto) : ?>
			<tr>
				<td><?= $producto->codigoPR; ?></td>
				<td><?= $producto->nombrePR; ?></td>
				<td><?= $producto->descripcionM; ?></td>
				<td><?= $producto->descripcionSC; ?></td>
				<td><?= $producto->descripcionCAT; ?></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-danger" title="Dejar de pausar" onclick="dejarPropiedad(this, '<?= base_url('quitarPausado/' . $producto->id_producto); ?>')">
							<i class="fas fa-times"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
