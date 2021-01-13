<table class="table table-sm table-hover">
	<thead class="text-center">
		<tr>
			<th>Código</th>
			<th>Producto</th>
			<th>Descuento (%)</th>
			<th>Precio Oferta</th>
			<th>Comenzó</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($ofertas_individuales as $oferta) : ?>
			<tr>
				<td><?= $oferta->codigoPR; ?></td>
				<td><?= $oferta->nombrePR; ?></td>
				<td class="text-right"><?= number_format($oferta->porcentaje, 2, ',', '.'); ?> %</td>
				<td class="text-right">$ <?= number_format($oferta->precio_ventaPR - ($oferta->precio_ventaPR * $oferta->porcentaje / 100), 2, ',', '.'); ?></td>
				<td class="text-center"><?= strftime("%d %b %Y", strtotime($oferta->fecha_inicio)); ?></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-warning" title="Editar" onclick="cargarForm('<?= base_url('frmEditarOfertaIndividual/' . $oferta->id_oferta) ?>', 'large', 'modal-large')">
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
