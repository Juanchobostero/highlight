<table id="<?= $id_tabla; ?>" class="table table-sm table-hover">
	<thead>
		<tr class="text-center">
			<th>Venta N°</th>
			<th>Cliente</th>
			<th>Total</th>
			<th>Fecha</th>
			<th>Pago</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($ventas as $venta) : ?>
			<?php // Estado de pago de la venta
			if ($venta->estadoPago == 'Aprobado') : $estPago = 'success';
			elseif ($venta->estadoPago == 'Pendiente') : $estPago = 'warning';
			else : $estPago = 'danger';
			endif; ?>
			<?php // Fecha del estado de venta
			if ($venta->estadoVENT == 'Nuevo') : $fecha = $venta->fechaEnvio;
			elseif ($venta->estadoVENT == 'Confirmado') : $fecha = $venta->fechaConfirmado;
			elseif ($venta->estadoVENT == 'Entregado') : $fecha = $venta->fechaEntregado;
			else : $fecha = $venta->fechaCancelado;
			endif; ?>
			<tr>
				<td><?= $venta->id_venta; ?></td>
				<td><?= $venta->apellidoU . ', ' . $venta->nombreU; ?></td>
				<td class="text-right">$ <?= number_format($venta->totalVENT, 0, ',', '.'); ?></td>
				<td class="text-center"><?= strftime("%d %b %Y", strtotime($fecha)); ?></td>
				<td class="text-center"><span class="badge badge-<?= $estPago; ?>"><?= $venta->estadoPago; ?></span></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerVenta/' . $venta->id_venta) ?>', 'large', 'modal-large')">
							<i class="fas fa-eye"></i>
						</button>

						<?php if ($venta->estadoVENT == 'Nuevo') : ?>
							<button type="button" class="btn btn-warning" title="Confirmar" onclick="confirmar(this, 'confirmarVenta/<?= $venta->id_venta; ?>')">
								<i class="fas fa-check text-white"></i>
							</button>
						<?php endif; ?>

						<?php if ($venta->estadoVENT == 'Confirmado') : ?>
							<button type="button" class="btn btn-warning" title="Entregar" onclick="cargarForm('<?= base_url('frmEditarProducto/' . 'id') ?>', 'extra-large', 'modal-extra-large')">
								<i class="fas fa-check text-white"></i>
							</button>
						<?php endif; ?>

						<?php if ($venta->estadoVENT != 'Cancelado') : ?>
							<button type="button" class="btn btn-danger" title="Cancelar" onclick="cancelar(this, 'cancelarVenta/<?= $venta->id_venta; ?>')">
								<i class="fas fa-times"></i>
							</button>
						<?php endif; ?>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
