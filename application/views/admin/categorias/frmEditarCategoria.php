<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Editar categoría</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_editCategoria" method="post" onsubmit="validFormMod(event, '<?= base_url('editarCategoria/' . $categoria->id_categoria) ?>')">
		<div class="form-group">
			<label for="categ" title="Obligatorio">Categoría <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="text" class="form-control" id="categ" name="categoria" placeholder="Introduce una categoría" value="<?= $categoria->descripcionCAT; ?>">
			<input type="hidden" name="categoriaAct" value="<?= $categoria->descripcionCAT; ?>">
		</div>
		<div class="form-group">
			<label class="mb-1">Imagen de categoría</label>
			<div id="noFoto" class="alert alert-danger text-center mb-1 mt-0 py-1 d-none">
				<small></small>
			</div>
			<img id="foto" name="foto-producto" class="mx-auto file-select hover img-fluid m-auto d-block rounded w-50 h-50" width="200px" src="<?= base_url($categoria->imagenCAT); ?>" title="Haga click para cambiar imagen" style="cursor:pointer;">
			<input id="ing-foto" class="d-none invisible" type="file" accept="image/*" name="file" onchange="subirFoto(this)" value="">
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times mr-2"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_editCategoria" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Actualizando...
		</div>
		<span id="nomForm"><i class="fas fa-pen mr-2"></i>Actualizar</span>
	</button>
</div>

<script>
	$('#foto').click(function() {
		$('#ing-foto').click();
	});

	$('.modal').on('shown.bs.modal', function() {
		$('#categ').focus();
		$('#categ').select();
	});
</script>
