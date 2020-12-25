<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/imagenes/_headerImagenes'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<form enctype="multipart/form-data" method="post" onsubmit="validFormPage(event, '<?= base_url('editarImagenes/' . $imagenes->id_img); ?>')">
			<div id="noFoto" class="alert alert-danger text-center mb-1 mt-0 py-1 d-none">
					<small><!-- Leyenda error --></small>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="container px-0" style="background-color: #343a40!important;">
							<div id="jumbotron_1" class="jumbotron jumbotron-image text-center text-white shadow" style="background-image: url(<?= base_url($imagenes->imagen_1); ?>);">
								<h2 class="mb-4 text">
									Presentación 1
								</h2>
								<div>
									<button type="button" class="btn btn-success file-button" onclick="getFile1()">
										<i class="fas fa-camera mr-2"></i>Cambiar
									</button>
									<div class="file-input">
										<input id="img_1" type="file" name="file_1">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.row -->
				<div class="row">
					<div class="col-12">
						<div class="container px-0" style="background-color: #343a40!important;">
							<div id="jumbotron_2" class="jumbotron jumbotron-image text-center text-white" style="background-image: url(<?= base_url($imagenes->imagen_2); ?>);">
								<h2 class="mb-4 text">
									Presentación 2
								</h2>
								<div>
									<button type="button" class="btn btn-success file-button" onclick="getFile2()">
										<i class="fas fa-camera mr-2"></i>Cambiar
									</button>
									<div class="file-input">
										<input id="img_2" type="file" name="file_2">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.row -->
				<button type="submit" id="btnForm" class="btn btn-primary btn-block" name="button">
					<div id="cargandoSpinner" class="d-none">
						<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
						Actualizando...
					</div>
					<span id="nomForm"><i class="fas fa-pen mr-2"></i>Actualizar</span>
				</button>
			</form>
		</div><!-- /.container-fluid -->
	</section><!-- /.content -->
</div>

<?php $this->load->view('admin/components/footer'); ?>

<script>
	var file1 = document.getElementById('img_1');
	var file2 = document.getElementById('img_2');

	function getFile1() {
		file1.click();
	};

	function getFile2() {
		file2.click();
	};

	file1.addEventListener('change', function(e) {
		if (validarFile(file1)) return;

		let ima = document.getElementById('jumbotron_1');
		ima.setAttribute('style', `background-image: url(${URL.createObjectURL(file1.files[0])})`);
	});

	file2.addEventListener('change', function(e) {
		if (validarFile(file2)) return;

		let ima = document.getElementById('jumbotron_2');
		ima.setAttribute('style', `background-image: url(${URL.createObjectURL(file2.files[0])})`);
	});
</script>
