<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Actualizar oferta individual</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<div class="row border-bottom mb-3">
		<div class="col-sm-4 col-12">
			<div class="description-block border-right">
				<h5 class="description-header"> <?= $oferta_ind->nombrePR ?></h5>
				<span class="text-center">Producto</span>
			</div>
		</div>
		<div class="col-sm-4 col-12">
			<div class="description-block border-right">
				<h5 class="description-header">$ <?= number_format($oferta_ind->precio_listaPR, 0, ',', '.'); ?></h5>
				<span class="text-center">Precio de lista</span>
			</div>
		</div>
		<div class="col-sm-4 col-12">
			<div class="description-block">
				<h5 class="description-header">$ <?= number_format($oferta_ind->precio_ventaPR, 0, ',', '.'); ?></h5>
				<span class="text-center">Precio de venta</span>
			</div>
		</div>
	</div>
	<form id="form_editOfertaInd" method="post" enctype="multipart/form-data">
		<input id="pr" type="hidden" value="<?= $oferta_ind->precio_ventaPR ?>">
		<div class="form-group">
			<label for="porcentaje" class="mb-0" title="Obligatorio">Porcentaje descuento [%] <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="number" class="form-control" id="porcentaje" name="porcentaje" step='0.01' placeholder="0" min="0" max="100" value="<?= $oferta_ind->porcentaje; ?>">
			<small class="form-text text-muted">Porcentaje de descuento sobre el precio de venta.</small>
		</div>
		<div class="form-group">
			<label for="pOferta" class="mb-0" title="Obligatorio">Precio de Oferta <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="number" class="form-control" id="pOferta" name="pOferta" step='0.01' placeholder="0,00" min="1" max="<?= $oferta_ind->precio_ventaPR; ?>">
			<small class="form-text text-muted">Precio final de oferta.</small>
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_editOfertaInd" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Registrando...
		</div>
		<span id="nomForm"><i class="fas fa-save mr-2"></i>Registrar</span>
	</button>
</div>

<script>
	$(function() {
		$('#pOferta').val(calcularPrecioOferta($('#pr').val(), $('#porcentaje').val()));
	});

	$('#porcentaje').on('keyup change', function() {
		$('#pOferta').val(calcularPrecioOferta($('#pr').val(), $('#porcentaje').val()));
	});

	$('#pOferta').on('keyup change', function() {
		$('#porcentaje').val(calcularPorcentaje($('#pr').val(), $('#pOferta').val()));
	});

	$('#form_editOfertaInd').submit(function(event) {
		validFormMod(event, '<?= base_url('editarOfertaIndividual/' . $oferta_ind->id_oferta); ?>')
	});
</script>
