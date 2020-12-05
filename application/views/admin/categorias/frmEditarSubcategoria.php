<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Editar subcategoría</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_editSubcategoria" method="post" onsubmit="validFormMod(event, '<?= base_url('editarSubcategoria/' . $subcategoria->id_subcategoria) ?>')">
		<div class="form-group">
			<label for="categ" title="Obligatorio">Categoría <span class="text-danger" title="Obligatorio">*</span></label>
			<select class="form-control" id="categ" name="categoria_id">
				<?php foreach ($categorias as $categoria) : ?>
					<?php $selected = ($categoria->id_categoria == $subcategoria->id_cat) ? 'selected' : ''; ?>
					<option value="<?= $categoria->id_categoria; ?>" <?= $selected; ?>><?= $categoria->descripcionCAT; ?></option>
				<?php endforeach; ?>
			</select>
			<input type="hidden" name="categoriaAct_id" value="<?= $subcategoria->id_cat; ?>">
		</div>
		<div class="form-group">
			<label for="subcateg" title="Obligatorio">Subcategoría <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="text" class="form-control" id="subcateg" name="subcategoria" placeholder="Introduce una subcategoría" value="<?= $subcategoria->descripcionSC; ?>">
			<input type="hidden" name="subcategoriaAct" value="<?= $subcategoria->descripcionSC; ?>">
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times mr-2"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_editSubcategoria" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Actualizando...
		</div>
		<span id="nomForm"><i class="fas fa-pen mr-2"></i>Actualizar</span>
	</button>
</div>

<script>
	$('.modal').on('shown.bs.modal', function() {
		$('#categ').focus();
	});
</script>
