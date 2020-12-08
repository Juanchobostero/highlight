<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Editar descripción de producto</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_descProducto" method="post" onsubmit="validFormMod(event, '<?= base_url('editarDescripcion/' . $producto->id_producto); ?>')">
		<div id="detalles">
			<?php if ($producto->descripcionPR) : ?>
				<?php $descProducto = json_decode($producto->descripcionPR, true); ?>
				<?php $num = 0; ?>
				<?php foreach ($descProducto as $key => $value) : ?>
					<?php $num += 1; ?>
					<div id="edit-det-<?= $num; ?>">
						<div class="card card-default">
							<div class="card-header p-2">
								<h3 class="card-title">Detalle</h3>
								<?php if ($num > 1) : ?>
									<div class="card-tools">
										<a href="javascript:eliminarCuota('edit-det-<?= $num; ?>')" type="button" class="btn btn-tool" title="Quitar detalle">
											<i class="fas fa-times"></i>
										</a>
									</div>
								<?php endif; ?>
							</div>
							<!-- /.card-header -->
							<div class="card-body p-2">
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group mb-0">
											<label class="mb-0" title="Obligatorio">Atributo <span class="text-danger" title="Obligatorio">*</span></label>
											<input type="text" class="form-control" name="atributos[]" placeholder="Introduce un atributo" value="<?= $key; ?>" required>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group mb-0">
											<label class="mb-0" title="Obligatorio">Valor <span class="text-danger" title="Obligatorio">*</span></label>
											<input type="text" class="form-control" name="valores[]" placeholder="Introduce un valor" value="<?= $value; ?>" required>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else : ?>
				<div class="card card-default">
					<div class="card-header p-2">
						<h3 class="card-title">Detalle</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-2">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group mb-0">
									<label class="mb-0" title="Obligatorio">Atributo <span class="text-danger" title="Obligatorio">*</span></label>
									<input type="text" class="form-control" name="atributos[]" placeholder="Introduce un atributo" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group mb-0">
									<label class="mb-0" title="Obligatorio">Valor <span class="text-danger" title="Obligatorio">*</span></label>
									<input type="text" class="form-control" name="valores[]" placeholder="Introduce un valor" required>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<!-- Boton que permite agregar detalles -->
		<div class="row">
			<div class="col-lg-3 col-md-12">
				<a href="javascript:agregaDetalle()" class="btn btn-success btn-sm" title="Agregar detalle"><i class="fas fa-plus fa-fw"></i> Agregar</a>
			</div>
		</div>
	</form>

	<!-- Card detalle a agregar en el DOM -->
	<div id="detalle" class="d-none">
		<div class="card card-default">
			<div class="card-header p-2">
				<h3 class="card-title">Detalle</h3>
				<div class="card-tools">
					<a type="button" class="btn btn-tool" title="Quitar detalle">
						<i class="fas fa-times"></i>
					</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body p-2">
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group mb-0">
							<label class="mb-0" title="Obligatorio">Atributo <span class="text-danger" title="Obligatorio">*</span></label>
							<input type="text" class="form-control" name="atributos[]" placeholder="Introduce un atributo" required>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group mb-0">
							<label class="mb-0" title="Obligatorio">Valor <span class="text-danger" title="Obligatorio">*</span></label>
							<input type="text" class="form-control" name="valores[]" placeholder="Introduce un valor" required>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times mr-2"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_descProducto" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Actualizando...
		</div>
		<span id="nomForm"><i class="fas fa-pen mr-2"></i>Actualizar</span>
	</button>
</div>

<script>
	var numDetalle = 1;

	function agregaDetalle() {
		numDetalle += 1;
		let div1 = document.createElement('div');
		div1.id = 'detalle-' + numDetalle;
		div1.innerHTML = document.getElementById('detalle').innerHTML;
		div1.getElementsByTagName('a')[0].href = "javascript:eliminarCuota('" + div1.id + "')";
		document.getElementById('detalles').appendChild(div1);
	}

	function eliminarCuota(eleId) {
		let elePadre = document.getElementById('detalles');
		let eleHijo = document.getElementById(eleId);
		elePadre.removeChild(eleHijo);
	}
</script>
