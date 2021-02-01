<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/institucional/_headerInstitucional'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-outline">
						<!-- /.card-header -->
						<form id="form_institucional" method="post" onsubmit="validFormPage(event, '<?= base_url('editarInstitucional/' . $institucional->id_institucional); ?>')">
							<div id='text-ins' class="card-body text-justify">
								<textarea id="summernote" name="descripcion" class="form-control d-none" rows="10">
									<?= $institucional->descripcion; ?>
								</textarea>
								<p><?= $institucional->descripcion; ?></p>
							</div>
						</form>
						<!-- /.card-body -->
						<div class="card-footer p-2">
							<div class="float-right">
								<button type="button" id="editar-ins" class="btn btn-primary"><i class="fas fa-file-alt mr-2"></i>Editar</button>
								<button type="submit" id="btnForm" form="form_institucional" class="btn btn-primary d-none" name="button">
									<div id="cargandoSpinner" class="d-none">
										<span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
										Actualizando...
									</div>
									<span id="nomForm"><i class="fas fa-pen mr-2"></i>Actualizar</span>
								</button>
							</div>
						</div>
						<!-- /.card-footer -->
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section><!-- /.content -->
</div>

<?php $this->load->view('admin/components/footer'); ?>

<script>
	$('#editar-ins').click(function() {
		$('#text-ins p').remove();
		$('#text-ins textarea').removeClass('d-none');
		$('#summernote').summernote({
			lang: 'es-ES',
			toolbar: [
				['style', ['style']],
				['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ol', 'ul', 'paragraph', 'height']],
				// ['table', ['table']],
				// ['insert', ['link']],
				['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
			]
		});
		$(this).remove();
		$('#btnForm').removeClass('d-none');
	})
</script>
