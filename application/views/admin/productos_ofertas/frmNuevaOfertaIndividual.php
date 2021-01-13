<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Nueva oferta individual</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_altaOfertaInd" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="producto" class="mb-0" title="Obligatorio">Producto <span class="text-danger" title="Obligatorio">*</span></label>
			<select class="select2" id="producto" name="producto_id" style="width: 100%;">
				<option value="0" disabled selected>Seleccione un producto</option>
				<?php foreach ($productos as $producto) : ?>
					<option value="<?= $producto->id_producto; ?>"><small>(<?= $producto->codigoPR; ?>)</small> <?= $producto->nombrePR; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div id="detProducto">
		</div>
		<div class="form-group">
			<label for="porcentaje" class="mb-0" title="Obligatorio">Porcentaje descuento [%] <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="number" class="form-control" id="porcentaje" name="porcentaje" step='0.01' placeholder="0" min="1" max="100" disabled>
			<small class="form-text text-muted">Porcentaje de descuento sobre el precio de venta.</small>
		</div>
		<div class="form-group">
			<label for="pOferta" class="mb-0" title="Obligatorio">Precio de Oferta <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="number" class="form-control" id="pOferta" name="pOferta" step='0.01' placeholder="0,00" min="1" disabled>
			<small class="form-text text-muted">Precio final de oferta.</small>
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_altaOfertaInd" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Registrando...
		</div>
		<span id="nomForm"><i class="fas fa-save mr-2"></i>Registrar</span>
	</button>
</div>

<script>
	$(function() {
		$('.select2').select2();
	});

	$('#producto').change(function() {
		let id_pr = $("#producto").val();
		if (id_pr) {
			cargarPage('getProductoOferta/' + id_pr, 'detProducto');
		}
	});

	$('#form_altaOfertaInd').submit(function(event) {
		validFormMod(event, '<?= base_url('altaOfertaIndividual'); ?>')
	});
</script>
