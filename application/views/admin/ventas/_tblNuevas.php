<table id="tblnuevas" class="table table-sm table-hover">
	<thead>
		<tr class="text-center">
			<th>Venta N°</th>
			<th>Cliente</th>
			<th>Total</th>
			<th>Fecha</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<!-- <?php// foreach ($productos as $producto) : ?> -->
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerNueva/' . 'id') ?>', 'extra-large', 'modal-extra-large')">
							<i class="fas fa-eye"></i>
						</button>
						<button type="button" class="btn btn-warning" title="Confirmar" onclick="cargarForm('<?= base_url('frmEditarProducto/' . 'id') ?>', 'extra-large', 'modal-extra-large')">
							<i class="fas fa-check text-white"></i>
						</button>
						<button type="button" class="btn btn-danger" title="Cancelar" onclick="eliminar(this, 'eliminarProducto/<?= 'id'; ?>')">
							<i class="fas fa-times"></i>
						</button>
					</div>
				</td>
			</tr>
		<!-- <?php //endforeach; ?> -->
	</tbody>
</table>
