<table id="tblsubcategorias" class="table table-sm table-hover">
	<thead class="text-center">
		<tr>
			<th>Categoría</th>
			<th>Subcategoría</th>
			<th>Total Productos</th>
			<th>Descuento (%)</th>
			<th>Comenzó</th>
			<th>Terminó *</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($ofertas_subcategorias as $oferta) : ?>
			<tr>
				<td><?= $oferta->descripcionCAT; ?></td>
				<td><?= $oferta->descripcionSC; ?></td>
				<td class="text-center"><?= $oferta->total_productos; ?></td>
				<td class="text-right"><?= number_format($oferta->porcentaje, 2, ',', '.'); ?> %</td>
				<td class="text-center"><?= strftime("%d %b %Y", strtotime($oferta->fecha_inicio)); ?></td>
				<td class="text-center"><?= ($oferta->fecha_fin) ? strftime("%d %b %Y", strtotime($oferta->fecha_fin)) : '-'; ?></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-warning" title="Editar" onclick="cargarForm('<?= base_url('frmEditarOfertaPorSubcategoria/' . $oferta->id_oferta) ?>', 'large', 'modal-large')">
							<i class="fas fa-pen text-white"></i>
						</button>
						<button type="button" class="btn btn-danger" title="Quitar oferta" onclick="eliminar(this, 'eliminarOferta/<?= $oferta->id_oferta; ?>')">
							<i class="fas fa-times"></i>
						</button>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<small class="text-muted">* Las ofertas que tienen fecha de caducidad se quitan automaticamente.</small>
