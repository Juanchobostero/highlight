<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Nuevo oferta</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_producto" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="codigo" class="mb-0" title="Obligatorio">Código <span class="text-danger" title="Obligatorio">*</span></label>
					<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Introduce un código">
				</div>
				<div class="form-group">
					<label for="nombre" class="mb-0" title="Obligatorio">Nombre <span class="text-danger" title="Obligatorio">*</span></label>
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce un nombre">
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_producto" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Registrando...
		</div>
		<span id="nomForm"><i class="fas fa-save mr-2"></i>Registrar</span>
	</button>
</div>
