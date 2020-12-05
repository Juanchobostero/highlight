<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Editar marca</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_editMarca" method="post" onsubmit="validFormMod(event, '<?= base_url('editarMarca/' . $marca->id_marca) ?>')">
		<div class="form-group">
			<label for="marc" title="Obligatorio">Marca <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="text" class="form-control" id="marc" name="marca" placeholder="Introduce una marca" value="<?= $marca->descripcionM; ?>">
			<input type="hidden" name="marcaAct" value="<?= $marca->descripcionM; ?>">
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times mr-2"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_editMarca" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Actualizando...
		</div>
		<span id="nomForm"><i class="fas fa-pen mr-2"></i>Actualizar</span>
	</button>
</div>

<script>
	$('.modal').on('shown.bs.modal', function() {
		$('#marc').focus();
		$('#marc').select();
	});
</script>
