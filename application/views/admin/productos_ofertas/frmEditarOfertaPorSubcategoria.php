<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Actualizar oferta por subcategoría</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<div class="row border-bottom mb-3">
		<div class="col-sm-4 col-12">
			<div class="description-block border-right">
				<h5 class="description-header"><?= $oferta_sub->descripcionSC; ?></h5>
				<span class="text-center">Subcategoría</span>
			</div>
		</div>
		<div class="col-sm-4 col-12">
			<div class="description-block border-right">
				<h5 class="description-header"><?= $oferta_sub->descripcionCAT; ?></h5>
				<span class="text-center">Categoría</span>
			</div>
		</div>
		<div class="col-sm-4 col-12">
			<div class="description-block">
				<h5 class="description-header"><?= $oferta_sub->total_productos; ?></h5>
				<span class="text-center">Productos en oferta</span>
			</div>
		</div>
	</div>
	<form id="form_editOfertaSub" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="porcentaje" class="mb-0" title="Obligatorio">Porcentaje descuento [%] <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="number" class="form-control" id="porcentaje" name="porcentaje" step='0.01' placeholder="0" min="0" max="100" value="<?= $oferta_sub->porcentaje; ?>">
			<small class="form-text text-muted">Porcentaje de descuento sobre el precio de venta.</small>
		</div>
		<div class="row">
			<div class="col-sm-6 col-12">
				<div class="form-group">
					<label for="fecha_inicio" class="mb-0" title="Obligatorio">Fecha de inicio <span class="text-danger" title="Obligatorio">*</span></label>
					<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" min="<?= ($oferta_sub->fecha_inicio > date('Y-m-d')) ? date('Y-m-d') : $oferta_sub->fecha_inicio; ?>" value="<?= $oferta_sub->fecha_inicio; ?>">
				</div>
			</div>
			<div class="col-sm-6 col-12">
				<div class="form-group">
					<label for="fecha_fin" class="mb-0">Fecha de finalización</label>
					<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" min="<?= $oferta_sub->fecha_inicio; ?>" value="<?= $oferta_sub->fecha_fin; ?>">
					<small class="form-text text-muted">Deje vacio si no desea fecha de finalización.</small>
				</div>
			</div>
		</div>
	</form>
	<div class="callout callout-info">
		<p id="caducidad"></p>
	</div>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_editOfertaSub" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Registrando...
		</div>
		<span id="nomForm"><i class="fas fa-save mr-2"></i>Registrar</span>
	</button>
</div>

<script>
	$(function() {
		duracionOferta();
	});

	$("#fecha_inicio").change(function() {
		let fechaIni = $(this).val();
		let fechaFin = $('#fecha_fin');
		fechaFin.attr('min', fechaIni);
		
		if (fechaFin.val() < fechaIni && fechaFin.val() != '') {
			fechaFin.val(fechaIni);
		}
		duracionOferta();
	});

	$("#fecha_fin").change(function() {
		duracionOferta();
	});

	$('#form_editOfertaSub').submit(function(event) {
		validFormMod(event, '<?= base_url('editarOfertaPorSubcategoria/' . $oferta_sub->id_oferta); ?>')
	});
</script>
