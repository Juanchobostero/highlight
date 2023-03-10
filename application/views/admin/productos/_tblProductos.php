<table id="tblactivos" class="table table-sm table-hover">
	<thead>
		<tr>
			<th>Código</th>
			<th>Producto</th>
			<th>Marca</th>
			<th>Precio Venta</th>
			<th>Pausado</th>
			<th>Destacado</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($productos as $producto) : ?>
			<tr>
				<td><?= $producto->codigoPR; ?></td>
				<td><?= $producto->nombrePR; ?></td>
				<td><?= $producto->descripcionM; ?></td>
				<td class="text-right">$ <?= number_format($producto->precio_ventaPR, 0, ',', '.'); ?></td>
				<td class="text-center">
					<input type="checkbox" name="pausar" <?= ($producto->pausadoPR == 'SI') ? 'checked' : '' ?> data-bootstrap-switch data-off-text="NO" data-on-text="SI" data-off-color="danger" onchange="manejoSwitch(this, <?= $producto->id_producto; ?>, '<?= base_url('pausarProducto') ?>', false)">
				</td>
				<td class="text-center">
					<input type="checkbox" name="destacar" <?= ($producto->destacadoPR == 'SI') ? 'checked' : '' ?> data-bootstrap-switch data-off-text="NO" data-on-text="SI" data-off-color="danger" onchange="manejoSwitch(this, <?= $producto->id_producto; ?>, '<?= base_url('destacarProducto') ?>', false)">
				</td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerProducto/' . $producto->id_producto) ?>', 'extra-large', 'modal-extra-large')">
							<i class="fas fa-eye"></i>
						</button>
						<button type="button" class="btn btn-warning" title="Editar" onclick="cargarForm('<?= base_url('frmEditarProducto/' . $producto->id_producto) ?>', 'extra-large', 'modal-extra-large')">
							<i class="fas fa-pen text-white"></i>
						</button>
						<button type="button" class="btn btn-danger" title="Eliminar" onclick="eliminar(this, 'eliminarProducto/<?= $producto->id_producto; ?>')">
							<i class="fas fa-trash-alt"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
