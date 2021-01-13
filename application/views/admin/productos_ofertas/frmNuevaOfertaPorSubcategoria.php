<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Nueva oferta por subcategoría</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_altaOfertaSub" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="subcategoria" class="mb-0" title="Obligatorio">Subcategoría <span class="text-danger" title="Obligatorio">*</span></label>
			<select class="select2" id="subcategoria" name="subcategoria_id" style="width: 100%;">
				<option value="0" disabled selected>Seleccione una subcategoría</option>
				<?php foreach ($subcategorias as $subcategoria) : ?>
					<option value="<?= $subcategoria->id_subcategoria; ?>"><?= $subcategoria->descripcionSC; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div id="detSubcategoria">
		</div>
		<div class="form-group">
			<label for="porcentaje" class="mb-0" title="Obligatorio">Porcentaje descuento [%] <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="number" class="form-control" id="porcentaje" name="porcentaje" step='0.01' placeholder="0" disabled>
			<small class="form-text text-muted">Porcentaje de descuento sobre el precio de venta.</small>
		</div>
		<div class="row">
			<div class="col-sm-6 col-12">
				<div class="form-group">
					<label for="fecha_inicio" class="mb-0" title="Obligatorio">Fecha de inicio <span class="text-danger" title="Obligatorio">*</span></label>
					<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" min="<?= date("Y-m-d"); ?>">
				</div>
			</div>
			<div class="col-sm-6 col-12">
				<div class="form-group">
					<label for="fecha_fin" class="mb-0">Fecha de finalización</label>
					<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" min="<?= date("Y-m-d"); ?>">
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

	<button type="submit" id="btnForm" form="form_altaOfertaSub" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Registrando...
		</div>
		<span id="nomForm"><i class="fas fa-save mr-2"></i>Registrar</span>
	</button>
</div>

<script>
	$('#fecha_inicio').val(fechaHoy());

	$(function() {
		$('.select2').select2();
		duracionOferta();
	});

	$('#subcategoria').change(function() {
		let id_sub = $("#subcategoria").val();
		if (id_sub) {
			cargarPage('getSubcategoriaOferta/' + id_sub, 'detSubcategoria');
		}
	});

	$("#fecha_inicio").change(function() {
		let fechaIni = $(this).val();
		let fechaFin = $('#fecha_fin');
		fechaFin.attr('min' , fechaIni);
		if (fechaFin.val() < fechaIni && fechaFin.val() != '') {
			fechaFin.val(fechaIni);
		}
		duracionOferta();
	});

	$("#fecha_fin").change(function() {
		duracionOferta();
	});

	$('#form_altaOfertaSub').submit(function(event) {
		validFormMod(event, '<?= base_url('altaOfertaPorSubcategoria'); ?>')
	});
</script>
