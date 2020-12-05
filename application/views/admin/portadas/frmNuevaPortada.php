<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Nueva portada</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_portada" enctype="multipart/form-data" method="post" onsubmit="validFormMod(event, '<?= base_url('altaPortada'); ?>')">
		<div class="form-group">
			<label for="titulo" title="Obligatorio">Título <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="text" class="form-control" id="titulo" name="titulo" placeholder="Introduce un titulo">
		</div>
		<div class="form-group">
			<label for="public" title="Obligatorio">Publicar? <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="checkbox" id="public" name="publicar" data-bootstrap-switch data-off-text="NO" data-on-text="SI">
		</div>
		<div class="form-group">
			<label for="public" class="mb-1">Imagen de portada</label>
			<div id="noFoto" class="alert alert-danger text-center mb-1 mt-0 py-1 d-none">
				<small><!-- Leyenda error --></small>
			</div>
			<img id="foto" name="foto-producto" class="mx-auto file-select hover img-fluid m-auto d-block rounded w-50 h-50" width="200px" src="<?= base_url('assets/img/portadas/no-portada.png'); ?>" title="Haga click para agregar una imagen" style="cursor:pointer;">
			<input id="ing-foto" class="d-none invisible" type="file" accept="image/*" name="file" onchange="subirFoto(this)" value="">
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_portada" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Registrando...
		</div>
		<span id="nomForm"><i class="fas fa-save mr-2"></i>Registrar</span>
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
		$('#titulo').focus()
	});
</script>
