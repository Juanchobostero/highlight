<div class="modal-header bg-primary py-2">
	<h5 class="modal-title"><?= $producto->nombrePR; ?></h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<div class="row">
		<div class="col-lg-5">
			<label class="mb-0">Imágenes</label>
			<?php if ($fotos) : ?>
				<img src="<?= base_url($fotos[0]->foto); ?>" class="product-image" alt="Foto principal">
				<div class="product-image-thumbs">
					<?php foreach ($fotos as $key => $foto) : ?>
						<div class="product-image-thumb <?= ($key == 0) ? 'active' : ''; ?>"><img src="<?= base_url($foto->foto); ?>" alt="Foto"></div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="col-lg-7" style="background-color: #EEE;">
			<label class="mb-1">Descripción</label>
			<?= $producto->descripcionPR; ?>
			<dl class="row">
				<dt class="col-sm-4">Código</dt>
				<dd class="col-sm-8"><?= $producto->codigoPR; ?></dd>
				<dt class="col-sm-4">Marca</dt>
				<dd class="col-sm-8"><?= $producto->descripcionM; ?></dd>
				<dt class="col-sm-4">Categoría</dt>
				<dd class="col-sm-8"><?= $producto->descripcionCAT; ?></dd>
				<dt class="col-sm-4">Subcategoría</dt>
				<dd class="col-sm-8"><?= $producto->descripcionSC; ?></dd>
				<dt class="col-sm-4">Stock</dt>
				<dd class="col-sm-8"><?= number_format($producto->stockPR, 0, ',', '.'); ?></dd>
				<dt class="col-sm-4">Precio Lista</dt>
				<dd class="col-sm-8">$ <?= number_format($producto->precio_listaPR, 0, ',', '.'); ?></dd>
				<dt class="col-sm-4">Precio Venta</dt>
				<dd class="col-sm-8">$ <?= number_format($producto->precio_ventaPR, 0, ',', '.'); ?></dd>
				<dt class="col-sm-12">Producto <?= ($producto->destacadoPR == 'NO') ? 'NO' : ''; ?> destacado</dt>
			</dl>
		</div>
	</div>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>
</div>

<script>
	$('.product-image-thumb').on('click', function() {
		var image_element = $(this).find('img')
		$('.product-image').prop('src', $(image_element).attr('src'))
		$('.product-image-thumb.active').removeClass('active')
		$(this).addClass('active')
	});
</script>
