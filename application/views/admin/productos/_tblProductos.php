<table class="table table-hover">
	<thead>
		<tr>
			<th>Código</th>
			<th>Producto</th>
			<th>Marca</th>
			<th>Subcategoría</th>
			<th>Categoría</th>
			<th>Precio Venta</th>
			<th>Stock</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($productos as $producto) : ?>
			<tr>
				<td><?= $producto->codigoPR; ?></td>
				<td><?= $producto->nombrePR; ?></td>
				<td><?= $producto->descripcionM; ?></td>
				<td><?= $producto->descripcionSC; ?></td>
				<td><?= $producto->descripcionCAT; ?></td>
				<td>$<?= $producto->precio_ventaPR; ?></td>
				<td><?= intval($producto->stockPR); ?></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerProducto/' . $producto->id_producto) ?>', 'small', 'modal-small')">
							<i class="fas fa-eye"></i>
						</button>
						<button type="button" class="btn btn-warning" title="Editar" onclick="cargarForm('<?= base_url('frmEditarProducto/' . $producto->id_producto) ?>', 'extra-large', 'modal-extra-large')">
							<i class="fas fa-pen text-white"></i>
						</button>
						<button type="button" class="btn bg-olive" title="Editar descripción" onclick="cargarForm('<?= base_url('frmEditarDescripcion/' . $producto->id_producto) ?>', 'small', 'modal-small')">
							<i class="fas fa-list-ul"></i>
						</button>
						<button type="button" class="btn btn-danger" title="Eliminar" onclick="deshabilitar(this, 'eliminarProducto/<?= $producto->id_producto; ?>')">
							<i class="fas fa-trash-alt"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
