<div class="modal-header bg-primary py-2">
	<h5 class="modal-title">Nuevo producto</h5>
	<button type="button" id="cerrarModal" class="close text-white" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="modal-body">
	<form id="form_producto" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="col-lg-5">
				<label>Imágenes</label>
				<div id="noFoto" class="alert alert-danger text-center mb-1 mt-0 py-1 d-none">
					<small>
						<!-- Leyenda error --></small>
				</div>
				<div id="imagenes" class="grid-container">
					<!-- Se cargan las fotos del producto -->
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
				<!-- <div id="imagenes">
					<input type="file" class="mb-1" name="file[]" accept="image/*">
				</div>
				<button type="button" id="agregarFoto" class="btn btn-success btn-sm mt-1">
					<i class="fas fa-file-medical mr-2"></i>Agregar
				</button> -->
			</div>
			<div class="col-lg-7">
				<div class="form-group">
					<label for="codigo" class="mb-0" title="Obligatorio">Código <span class="text-danger" title="Obligatorio">*</span></label>
					<input type="text" class="form-control" id="codigo" name="codigo" placeholder="Introduce un código">
				</div>
				<div class="form-group">
					<label for="nombre" class="mb-0" title="Obligatorio">Nombre <span class="text-danger" title="Obligatorio">*</span></label>
					<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce un nombre">
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="stock" class="mb-0" title="Obligatorio">Stock <span class="text-danger" title="Obligatorio">*</span></label>
							<input type="number" class="form-control" id="stock" name="stock" placeholder="0,000">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="marca" class="mb-0" title="Obligatorio">Marca <span class="text-danger" title="Obligatorio">*</span></label>
							<select class="form-control" id="marca" name="marca_id">
								<option value="0" disabled selected>Seleccione una marca</option>
								<?php foreach ($marcas as $marca) : ?>
									<option value="<?= $marca->id_marca; ?>"><?= $marca->descripcionM; ?></option>
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
									<option value="<?= $categoria->id_categoria; ?>"><?= $categoria->descripcionCAT; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="subcategoria" class="mb-0" title="Obligatorio">Subcategoría <span class="text-danger" title="Obligatorio">*</span></label>
							<select class="form-control" id="subcategoria" name="subcategoria_id">
								<option value="0" disabled selected>Seleccione una subcategoría</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="pLista" class="mb-0" title="Obligatorio">Precio lista <span class="text-danger" title="Obligatorio">*</span></label>
							<input type="number" class="form-control" id="pLista" name="pLista" placeholder="0,00">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="pVenta" class="mb-0" title="Obligatorio">Precio venta <span class="text-danger" title="Obligatorio">*</span></label>
							<input type="number" class="form-control" id="pVenta" name="pVenta" placeholder="0,00">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="destacar" class="mb-0 mr-2" title="Obligatorio">Destacar? <span class="text-danger" title="Obligatorio">*</span></label>
					<input type="checkbox" id="destacar" name="destacar" data-bootstrap-switch data-off-text="NO" data-on-text="SI">
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

<script>
	var file = document.getElementById('fotos');
	var form = new FormData();

	$(function() {
		$("input[data-bootstrap-switch]").bootstrapSwitch();
	});

	$('.modal').on('shown.bs.modal', function() {
		$('#codigo').focus()
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

	$('#form_producto').submit(function(event) {
		let formComp = new FormData($('#form_producto')[0]);
		for (let pair of form.entries()) {
			formComp.append(pair[0], pair[1]);
		};
		validFormMod(event, '<?= base_url('altaProducto'); ?>', formComp);
	});
	// $('#agregarFoto').click(function(e) {
	// 	e.preventDefault();
	// 	$('#imagenes').append("<div><input type='file' class='mb-1 mr-1' name='file[]' accept='image/*'><button class='btn btn-danger btn-sm' title='Quitar' onclick='eliminarFoto(event, this)'><i class='fas fa-times'></i></button></div>");
	// });

	// function eliminarFoto(e, ele) {
	// 	e.preventDefault();
	// 	$(ele).parent().remove();
	// }
</script>
