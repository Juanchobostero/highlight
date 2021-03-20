<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/productos/_headerProductos'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<button class="btn bg-gradient-primary mb-3" onclick="cargarForm('<?= base_url('frmNuevoProducto') ?>', 'extra-large', 'modal-extra-large')">
				<i class="fas fa-plus fa-fw"></i> Nuevo
			</button>
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-tabs">
						<div class="card-header p-0 pt-2">
							<ul class="nav nav-tabs" id="productos" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#activos" role="tab">Activos</a>
								</li>
							</ul>
						</div>

						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="activos" role="tabpanel">
									<div class="overlay-wrapper py-5">
										<div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
											<div class="text-bold pt-2">Cargando...</div>
										</div>
										<div id="tabla-activos">
										</div>
									</div>
								</div>
							</div>
						</div><!-- /.card -->
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</section><!-- /.content -->
</div>

<?php $this->load->view('admin/components/footer'); ?>

<script>
	window.onload = function() {
		let $tabs = $('#productos a')
		let $titulo = $('#tit-productos')
		let nomTab = 'Productos';

		$tabs.click(function() {
			window.location.hash = this.hash;
			manageHashTab($tabs, $titulo, nomTab);
		});

		if (window.location.hash == '') {
			window.location.hash = $tabs[0].hash;
		}
		manageHashTab($tabs, $titulo, nomTab);
	}
</script>
