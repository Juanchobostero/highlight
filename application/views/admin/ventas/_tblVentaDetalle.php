<table class="table table-sm table-striped">
	<thead>
		<tr class="text-center">
			<th>Codigo</th>
			<th>Producto</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($venta->detalle as $item) : ?>
			<tr>
				<td><?= $item->codigoPR; ?></td>
				<td><?= $item->nombrePR; ?></td>
				<td class="text-right">$ <?= number_format($item->precioVENT, 0, ',', '.'); ?></td>
				<td class="text-right"><?= number_format($item->cantidadVENT, 0, ',', '.'); ?></td>
				<td class="text-right">$ <?= number_format($item->subtotalVENT, 0, ',', '.'); ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
