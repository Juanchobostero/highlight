<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Enviar pedido</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body pt-0">
	<div class="mb-2">
		<small class="text-muted">Introduce los datos de seguimiento del envio. Estos serán enviados al cliente.</small>
	</div>
	<form id="form_enviarVenta" method="post" onsubmit="validFormMod(event, '<?= base_url('enviarVenta'); ?>')">
		<div class="form-group">
			<label for="num-seguimiento" title="Obligatorio">N° de seguimiento <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="text" class="form-control" id="num-seguimiento" name="nseguimiento" placeholder="Introduce el número de seguimiento">
		</div>
		<div class="form-group">
			<label for="empresa" title="Obligatorio">Empresa <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="text" class="form-control" id="empresa" name="empresa" placeholder="Introduce la empresa">
		</div>
		<div class="form-group">
			<label for="link" title="Obligatorio">Link <span class="text-danger" title="Obligatorio">*</span></label>
			<input type="text" class="form-control" id="link" name="link" placeholder="Introduce el enlace de seguimiento">
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_enviarVenta" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Registrando...
		</div>
		<span id="nomForm"><i class="fas fa-paper-plane mr-2"></i>Enviar</span>
	</button>
</div>

<script>
	$('.modal').on('shown.bs.modal', function() {
		$('#num-seguimiento').focus()
	});
</script>
