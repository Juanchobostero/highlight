<?php if ($estado_producto == 1) : ?>
	<div id="alert-oferta" class="alert alert-danger">
		<h5><i class="icon fas fa-ban"></i> Producto en oferta!</h5>
		El producto '<?= $producto->nombrePR; ?>' ya se encuentra en oferta. Por favor seleccione otro . . .
	</div>
<?php elseif ($estado_producto == 2) : ?>
	<div id="alert-oferta" class="alert alert-danger">
		<h5><i class="icon fas fa-ban"></i> Producto de oferta por subcategoría!</h5>
		El producto '<?= $producto->nombrePR; ?>' pertenece a la subcategoría -*<?= $producto->descripcionSC; ?>*- [Categoria: <?= $producto->descripcionCAT; ?>] ya se encuentra en oferta en la sección *por subcategoría*. Por favor seleccione otro . . .
	</div>
<?php else : ?>
	<div class="row border-bottom mb-3">
		<div class="col-sm-6 col-12">
			<div class="description-block border-right">
				<h5 class="description-header">$ <?= number_format($producto->precio_listaPR, 0, ',', '.'); ?></h5>
				<span class="text-center">Precio de lista</span>
			</div>
		</div>
		<div class="col-sm-6 col-12">
			<div class="description-block">
				<h5 class="description-header">$ <?= number_format($producto->precio_ventaPR, 0, ',', '.'); ?></h5>
				<span class="text-center">Precio de venta</span>
			</div>
		</div>
	</div>
	<input id="pr" type="hidden" value="<?= $producto->precio_ventaPR ?>">
<?php endif; ?>

<script>
	var estParam = false;
	
	if ($('#alert-oferta').length) {
		$('#porcentaje').val('');
		$('#pOferta').val('');
		estParam = true;
	};

	$('#pOferta').prop('max', $('#pr').val());
	$('#porcentaje').prop('disabled', estParam);
	$('#pOferta').prop('disabled', estParam);
	$('#btnForm').prop('disabled', estParam);

	$('#porcentaje').on('keyup change', function() {
		$('#pOferta').val(calcularPrecioOferta($('#pr').val(), $('#porcentaje').val()));
	});

	$('#pOferta').on('keyup change', function() {
		$('#porcentaje').val(calcularPorcentaje($('#pr').val(), $('#pOferta').val()));
	});
</script>
