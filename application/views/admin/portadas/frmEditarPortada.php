<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Editar portada</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_editPort" enctype="multipart/form-data" method="post" onsubmit="validFormMod(event, '<?= base_url('editarPortada/' . $portada->id_port) ?>')">
		<div class="form-group">
			<label for="titulo" title="Obligatorio">Título <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Introduce un título" value="<?= $portada->titulo; ?>">
		</div>
		<div class="form-group">
			<label for="public" title="Obligatorio">Publicar? <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="checkbox" id="public" name="publicar" <?= ($portada->publicado == 'SI') ? 'checked' : ''; ?> data-bootstrap-switch data-off-text="NO" data-on-text="SI">
		</div>
		<div class="form-group">
			<label for="public" class="mb-1">Imagen de portada</label>
			<div id="noFoto" class="alert alert-danger text-center mb-1 mt-0 py-1 d-none">
				<small></small>
			</div>
			<img id="foto" name="foto-producto" class="mx-auto file-select hover img-fluid m-auto d-block rounded w-50 h-50" width="200px" src="<?= base_url($portada->imagen); ?>" title="Haga click para cambiar imagen" style="cursor:pointer;">
			<input id="ing-foto" class="d-none invisible" type="file" accept="image/*" name="file" onchange="subirFoto(this)" value="">
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times mr-2"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_editPort" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Actualizando...
		</div>
		<span id="nomForm"><i class="fas fa-pen mr-2"></i>Actualizar</span>
	</button>
</div>

<script>
	$(function() {
		$("input[data-bootstrap-switch]").bootstrapSwitch();
	});

	$('#foto').click(function() {
		$('#ing-foto').click();
	});

	$('.modal').on('shown.bs.modal', function() {
		$('#titulo').focus();
		$('#titulo').select();
	});
</script>
