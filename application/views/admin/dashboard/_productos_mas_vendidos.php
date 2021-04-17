<div class="card">
	<div class="card-header">
		<h3 class="card-title">Productos más vendidos</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body p-0">
		<ul class="products-list product-list-in-card pl-2 pr-2">
			<?php foreach ($prods_mas_vendidos as $producto) : ?>
				<li class="item">
				<div class="product-img">
						<img src="<?= base_url($producto->foto); ?>" alt="Pr" class="img-size-50">
					</div>
					<div class="product-info">
						<a href="javascript:cargarForm('<?= base_url('frmVerProducto/' . $producto->id_producto) ?>', 'extra-large', 'modal-extra-large')" class="product-title"><?= $producto->nombrePR; ?>
							<span class="badge badge-success float-right"><?= number_format($producto->cantidad, 0, ',', '.'); ?> uds.</span></a>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<!-- /.card-body -->
	<div class="card-footer text-center">
		<a href="<?= base_url('admin/balance'); ?>" class="uppercase">Ver todos</a>
	</div>
	<!-- /.card-footer -->
</div>
<!-- /.card -->
