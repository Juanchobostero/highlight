<table id="<?= $id_tabla; ?>" class="table table-sm table-hover">
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
		<?php foreach ($ventas as $venta) : ?>
			<?php // Fecha del estado de venta
			if ($venta->estadoVENT == 'Nuevo') : $fecha = $venta->fechaEnvio;
			elseif ($venta->estadoVENT == 'Enviado') : $fecha = $venta->fechaConfirmado;
			elseif ($venta->estadoVENT == 'Entregado') : $fecha = $venta->fechaEntregado;
			else : $fecha = $venta->fechaCancelado;
			endif; ?>
			<tr>
				<td><?= $venta->id_venta; ?></td>
				<td><?= $venta->apellidoU . ', ' . $venta->nombreU; ?></td>
				<td class="text-right">$ <?= number_format($venta->totalVENT, 0, ',', '.'); ?></td>
				<td class="text-center"><?= strftime("%d %b %Y", strtotime($fecha)); ?></td>
				<td class="text-center">
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info" title="Ver" onclick="cargarForm('<?= base_url('frmVerVenta/' . $venta->id_venta) ?>', 'large', 'modal-large')">
							<i class="fas fa-eye fa-fw"></i>
						</button>

						<?php if ($venta->estadoVENT == 'Nuevo') : ?>
							<button type="button" class="btn btn-success" title="Confirmar envio" <?php if ($venta->envioVENT) : ?> onclick="envioVenta(this, 'enviarVentaSucursal/<?= $venta->id_venta; ?>')" <?php else : ?> onclick="cargarForm('<?= base_url('frmEnviarVenta/' . $venta->id_venta) ?>', 'small', 'modal-small')"<?php endif; ?>>
								<i class="fas fa-paper-plane fa-fw"></i>
							</button>
						<?php endif; ?>

						<?php if ($venta->estadoVENT == 'Enviado') : ?>
							<button type="button" class="btn btn-success" title="Marcar como entregado" onclick="entregar(this, 'entregarVenta/<?= $venta->id_venta;?>')">
								<i class="fas fa-check"></i>
							</button>
						<?php endif; ?>

						<?php if ($venta->estadoVENT == 'Nuevo') : ?>
							<button type="button" class="btn btn-danger" title="Cancelar" onclick="cancelar(this, 'cancelarVenta/<?= $venta->id_venta; ?>')">
								<i class="fas fa-times fa-fw"></i>
							</button>
						<?php endif; ?>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
