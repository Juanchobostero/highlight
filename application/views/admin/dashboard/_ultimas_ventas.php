<div class="card">
	<div class="card-header border-transparent">
		<h3 class="card-title">Ultimas ventas</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table m-0">
				<thead>
					<tr>
						<th>Venta N°</th>
						<th>Cliente</th>
						<th>Total</th>
						<th>Pago</th>
						<th>Fecha</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($ult_ventas as $venta) : ?>
						<tr>
							<td>
								<a href="javascript:cargarForm('<?= base_url('frmVerVenta/' . $venta->id_venta) ?>', 'large', 'modal-large')" title="Ver venta"><?= $venta->id_venta; ?></a>
							</td>
							<td><?= $venta->apellidoU . ', ' . $venta->nombreU; ?></td>
							<td class="text-right">$ <?= number_format($venta->totalVENT, 0, ',', '.'); ?></td>
							<td class="text-center">
								<span class="badge badge-success"><?= $venta->estadoPago; ?></span>
							</td>
							<td class="text-center"><?= strftime("%d %b %Y", strtotime($venta->fechaEnvio)); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<!-- /.table-responsive -->
	</div>
	<!-- /.card-body -->
	<div class="card-footer clearfix">
		<a href="<?= base_url('admin/ventas'); ?>" class="btn btn-sm btn-secondary float-right">Ver todas</a>
	</div>
	<!-- /.card-footer -->
</div>
