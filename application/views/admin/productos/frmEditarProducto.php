<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Actualizar producto</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_editProducto" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-5">
				<label class="mb-0">Imágenes</label>
				<div id="noFoto" class="alert alert-danger text-center mb-1 mt-0 py-1 d-none">
					<small><!-- Leyenda error --></small>
				</div>
				<div id="imagenes" class="grid-container">
					<?php if ($fotos) : ?>
						<?php foreach ($fotos as $foto) : ?>
							<div id="<?= $foto->id_foto; ?>" class="grid-item" style="background-image: url('<?= base_url($foto->foto); ?>');">
								<div class="capa">
									<!-- <span><i class="fas fa-expand-arrows-alt"></i></span> -->
									<span onclick="eliminarFotoBD(<?= $foto->id_foto; ?>)"><i class="fas fa-trash"></i></span>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div>
					<button type="button" class="btn btn-success file-button btn-sm mt-1" onclick="getFile()">
						<i class="fas fa-camera mr-2"></i>Agregar
					</button>
					<div class="file-input">
						<input id="fotos" type="file" name="file[]" multiple>
					</div>
				</div>
				<br>
			</div>

			<div class="col-lg-7">
				<div class="form-group">
					<label for="codigo" class="mb-0" title="Obligatorio">Código <span class="text-danger" title="Obligatorio">*</span></label>
					<input type="hidden" name="codigoAct" value="<?= $producto->codigoPR; ?>">
					<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Introduce un código" value="<?= $producto->codigoPR; ?>">
				</div>
				<div class="form-group">
					<label for="nombre" class="mb-0" title="Obligatorio">Nombre <span class="text-danger" title="Obligatorio">*</span></label>
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce un nombre" value="<?= $producto->nombrePR; ?>">
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="stock" class="mb-0" title="Obligatorio">Stock <span class="text-danger" title="Obligatorio">*</span></label>
							<input type="number" class="form-control" id="stock" name="stock" placeholder="0,000" value="<?= intval($producto->stockPR); ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="marca" class="mb-0" title="Obligatorio">Marca <span class="text-danger" title="Obligatorio">*</span></label>
							<select class="form-control" id="marca" name="marca_id">
								<option value="0" disabled selected>Seleccione una marca</option>
								<?php foreach ($marcas as $marca) : ?>
									<?php $selected = ($producto->id_mar == $marca->id_marca) ? 'selected' : ''; ?>
									<option value="<?= $marca->id_marca; ?>" <?= $selected; ?>><?= $marca->descripcionM; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="categoria" class="mb-0" title="Obligatorio">Categoría <span class="text-danger" title="Obligatorio">*</span></label>
							<select class="form-control" id="categoria" name="categoria_id">
								<option value="0" disabled selected>Seleccione una categoría</option>
								<?php foreach ($categorias as $categoria) : ?>
									<?php $selected = ($producto->id_cat == $categoria->id_categoria) ? 'selected' : ''; ?>
									<option value="<?= $categoria->id_categoria; ?>" <?= $selected; ?>><?= $categoria->descripcionCAT; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="subcategoria" class="mb-0" title="Obligatorio">Subcategoría <span class="text-danger" title="Obligatorio">*</span></label>
							<select class="form-control" id="subcategoria" name="subcategoria_id" required>
								<option value="0" disabled>Seleccione una subcategoría</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="pLista" class="mb-0" title="Obligatorio">Precio lista <span class="text-danger" title="Obligatorio">*</span></label>
							<input type="number" class="form-control" id="pLista" name="pLista" placeholder="0,00" value="<?= $producto->precio_listaPR ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="pVenta" class="mb-0" title="Obligatorio">Precio venta <span class="text-danger" title="Obligatorio">*</span></label>
							<input type="number" class="form-control" id="pVenta" name="pVenta" placeholder="0,00" value="<?= $producto->precio_ventaPR ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="destacar" class="mb-0 mr-2" title="Obligatorio">Destacar? <span class="text-danger" title="Obligatorio">*</span></label>
					<input type="checkbox" id="destacar" name="destacar" <?= ($producto->destacadoPR == 'SI') ? 'checked' : ''; ?> data-bootstrap-switch data-off-text="NO" data-on-text="SI">
				</div>
			</div>
		</div>
	</form>
</div>

<div class="modal-footer bg-gradient-light mt-0 py-1">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">
		<i class="fas fa-times fa-fw"></i>Cerrar
	</button>

	<button type="submit" id="btnForm" form="form_editProducto" class="btn btn-primary" name="button">
		<div id="cargandoSpinner" class="d-none">
			<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
			Actualizando...
		</div>
		<span id="nomForm"><i class="fas fa-pen mr-2"></i>Actualizar</span>
	</button>
</div>

<script>
	var file = document.getElementById('fotos');
	var form = new FormData();

	$(function() {
		getSubcategorias('<?= $producto->id_cat; ?>');
		$("input[data-bootstrap-switch]").bootstrapSwitch();
	});

	$('.modal').on('shown.bs.modal', function() {
		$('#codigo').focus();
		$('#codigo').select();
	});

	$("#categoria").change(() => getSubcategorias());

	function getFile() {
		document.getElementById("fotos").click();
	};

	file.addEventListener('change', function(e) {
		if (validarFile(file)) return;
		for (var i = 0; i < file.files.length; i++) {
			let thumbnail_id = Date.now() + '_' + i;
			crearThumbnail(file, i, thumbnail_id);
			form.append(thumbnail_id, file.files[i]);
		}
		e.target.value = '';
	});

	function eliminarFoto(id) {
		$('#' + id).fadeOut();
		form.delete(id);
	};
	
	$('#form_editProducto').submit(function(event) {
		let formComp = new FormData($('#form_editProducto')[0]);
		for (let pair of form.entries()) {
			formComp.append(pair[0], pair[1]);
		};
		validFormMod(event, '<?= base_url('editarProducto/' . $producto->id_producto); ?>', formComp);
	});
</script>
