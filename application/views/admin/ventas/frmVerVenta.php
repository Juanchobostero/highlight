<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Detalle de venta N° <?= $venta->id_venta; ?></h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<div class="row">
		<div class="col-12 col-md-4">
			<div class="info-box bg-light">
				<div class="info-box-content">
					<span class="info-box-text text-center text-muted">Cliente</span>
					<span class="info-box-number text-center text-muted mb-0"><?= $venta->apellidoU . ', ', $venta->nombreU; ?></span>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-3">
			<div class="info-box bg-light">
				<div class="info-box-content">
					<?php // Fecha del estado de venta
					if ($venta->estadoVENT == 'Nuevo') : $fecha = $venta->fechaEnvio;
					elseif ($venta->estadoVENT == 'Confirmado') : $fecha = $venta->fechaConfirmado;
					elseif ($venta->estadoVENT == 'Entregado') : $fecha = $venta->fechaEntregado;
					else : $fecha = $venta->fechaCancelado;
					endif; ?>
					<span class="info-box-text text-center text-muted">Fecha<?= ($venta->estadoVENT != 'Nuevo') ? ' ' . $venta->estadoVENT : ''; ?></span>
					<span class="info-box-number text-center text-muted mb-0"><?= strftime("%d %b %Y", strtotime($fecha)); ?><span>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-3">
			<div class="info-box bg-light">
				<div class="info-box-content">
					<span class="info-box-text text-center text-muted">Total</span>
					<span class="info-box-number text-center text-muted mb-0">$ <?= number_format($venta->totalVENT, 0, ',', '.'); ?><span>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-2">
			<div class="info-box bg-light">
				<div class="info-box-content">
					<?php // Estado de pago de la venta
					if ($venta->estadoPago == 'Aprobado') : $estPago = 'success';
					elseif ($venta->estadoPago == 'Pendiente') : $estPago = 'warning';
					else : $estPago = 'danger';
					endif; ?>
					<span class="info-box-text text-center text-muted">Pago</span>
					<span class="info-box-number text-center mb-0"><span class="badge badge-<?= $estPago; ?>"><?= $venta->estadoPago; ?></span>
				</div>
			</div>
		</div>
	</div>

	<hr class="mt-0 mb-3">

	<?php $this->load->view('admin/ventas/_tblVentaDetalle'); ?>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>
</div>
