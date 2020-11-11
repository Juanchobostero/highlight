<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/perfil/_headerPerfil'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card card-outline card-info">
				<div class="card-header">
					<div class="card-title"><strong>Editar Perfil</strong></div>
				</div>
				<div class="card-body">
					<form id="form_editPerfil" enctype="multipart/form-data" method="post" onsubmit="validFormPage(event, '<?= base_url('editarPerfil'); ?>')">
						<div class="row align-items-center justify-content-center">
							<div class="col-md-5">
								<div class="text-center">
									<img id="foto" name="foto-producto" class="box-img img-circle" src="<?= base_url($_SESSION['foto']); ?>" alt="foto" style="cursor:pointer;">
									<input id="ing-foto" class="d-none invisible" type="file" accept="image/*" name="file" onchange="subirFoto(this)" value="">
									<div id="noFoto" class="alert alert-danger text-center mb-1 mt-0 py-1 d-none">
										<small></small>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label for="nombre" class="mb-0">Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce un titulo" value="<?= $_SESSION['nombre']; ?>">
								</div>
								<div class="form-group">
									<label for="apellido" class="mb-0">Apellido</label>
									<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Introduce un apellido" value="<?= $_SESSION['apellido']; ?>">
								</div>
								<div class="form-group">
									<label for="telefono" class="mb-0">Teléfono</label>
									<input type="number" class="form-control" id="telefono" name="telefono" placeholder="Introduce un teléfono" value="<?= $_SESSION['telefono']; ?>">
								</div>
								<div class="form-group">
									<label for="mail" class="mb-0" title="Campo obligatorio">E-Mail <span class="text-danger" title="Campo obligatorio">*</span></label>
									<input type="email" class="form-control" id="mail" name="mail" placeholder="Introduce un e-mail" value="<?= $_SESSION['correo']; ?>">
								</div>
								<button type="submit" id="btnForm" class="btn btn-primary" name="button">
									<div id="cargandoSpinner" class="d-none">
										<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
										Actualizando...
									</div>
									<span id="nomForm"><i class="fas fa-pen mr-2"></i>Actualizar</span>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<?php $this->load->view('admin/components/footer'); ?>

<script>
	window.onload = function() {
		$('#foto').click(function() {
			$('#ing-foto').click();
		});
	}
</script>
