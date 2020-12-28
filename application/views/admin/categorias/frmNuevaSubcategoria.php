<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Nueva subcategoría</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_subcategoria" method="post" onsubmit="validFormMod(event, '<?= base_url('altaSubcategoria'); ?>')">
		<div class="form-group">
			<label for="categ" title="Obligatorio">Categoría <span class="text-danger" title="Obligatorio">*</span></label>
			<select class="select2" id="categ" name="categoria_id" style="width: 100%;">
				<option value="0" disabled selected>Seleccione una categoría</option>
				<?php foreach ($categorias as $categoria) : ?>
					<option value="<?= $categoria->id_categoria; ?>"><?= $categoria->descripcionCAT; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="subcateg" title="Obligatorio">Subcategoría <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="text" class="form-control" id="subcateg" name="subcategoria" placeholder="Introduce una subcategoría">
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_subcategoria" class="btn btn-primary" name="button">
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

	$('.modal').on('shown.bs.modal', function() {
		$('#categ').focus()
	});
</script>
