<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Editar cliente</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_editCliente" enctype="multipart/form-data" method="post" onsubmit="validFormMod(event, '<?= base_url('editarCliente/' . $cliente->id_usuario) ?>')">
		<div class="form-group">
			<label for="nombre" class="mb-0" title="Campo obligatorio">Nombre <span class="text-danger" title="Campo obligatorio">*</span></label>
			<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce un nombre" value="<?= $cliente->nombreU; ?>">
		</div>
		<div class="form-group">
			<label for="apellido" class="mb-0">Apellido</label>
			<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Introduce un apellido" value="<?= $cliente->apellidoU; ?>">
		</div>
		<div class="form-group">
			<label for="telefono" class="mb-0">Teléfono</label>
			<input type="number" class="form-control" id="telefono" name="telefono" placeholder="Introduce un teléfono" value="<?= $cliente->telefonoU; ?>">
		</div>
		<div class="form-group">
			<label for="public" class="mb-1">Foto de perfil</label>
			<div id="noFoto" class="alert alert-danger text-center mb-1 mt-0 py-1 d-none">
				<small></small>
			</div>
			<img id="foto" name="foto-cliente" class="mx-auto file-select hover img-fluid m-auto d-block rounded w-50 h-50" width="200px" src="<?= base_url($cliente->fotoU); ?>" title="Haga click para cambiar la foto" style="cursor:pointer;">
			<input id="ing-foto" class="d-none invisible" type="file" accept="image/*" name="file" onchange="subirFoto(this)" value="">
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times mr-2"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_editCliente" class="btn btn-primary" name="button">
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
		$('#titulo').focus();
		$('#titulo').select();
	});
</script>
