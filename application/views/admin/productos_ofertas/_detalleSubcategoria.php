<?php if (!$estado_subcategoria) : ?>
	<?php if ($productos_en_oferta > 0) : ?>
		<div class="alert alert-warning">
			<h5><i class="icon fas fa-exclamation-triangle"></i> Subcategoría con productos en oferta!</h5>
			La subcategoría '<?= $subcategoria->descripcionSC; ?>' tiene <?= $productos_en_oferta; ?> producto/s en oferta/s individual/es. ESTE/ESTOS PRODUCTO/S SE QUITARÁ/N . . .
		</div>
	<?php endif; ?>
	<div class="row border-bottom mb-3">
		<div class="col-sm-6 col-12">
			<div class="description-block border-right">
				<h5 class="description-header"><?= $subcategoria->descripcionCAT; ?></h5>
				<span class="text-center">Categoría</span>
			</div>
		</div>
		<div class="col-sm-6 col-12">
			<div class="description-block">
				<h5 class="description-header"><?= $total_productos; ?></h5>
				<span class="text-center">Productos a poner en oferta</span>
			</div>
		</div>
	</div>
<?php else : ?>
	<div id="alert-oferta" class="alert alert-danger">
		<h5><i class="icon fas fa-ban"></i> Subcategoría en oferta!</h5>
		La subcategoría '<?= $subcategoria->descripcionSC; ?>' perteneciente a la categoría '<?= $subcategoria->descripcionCAT; ?>' ya se encuentra en oferta. Por favor seleccione otra . . .
	</div>
<?php endif; ?>

<script>
	var estParam = false;

	if ($('#alert-oferta').length) {
		$('#porcentaje').val('');
		estParam = true;
	};

	$('#porcentaje').prop('disabled', estParam);
</script>
