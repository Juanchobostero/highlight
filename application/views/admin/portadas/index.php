<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/portadas/_headerPortadas');?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<button class="btn bg-gradient-primary mb-3" onclick="cargarForm('<?= base_url('frmNuevaPortada') ?>', 'small', 'modal-small')">
				<i class="fas fa-plus fa-fw"></i> Nueva
			</button>
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-tabs">
						<div class="card-header p-0 pt-2">
							<ul class="nav nav-tabs" id="portadas" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="custom-tabs-five-overlay-tab" data-toggle="tab" href="#publicadas" role="tab">Publicadas</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="custom-tabs-five-overlay-dark-tab" data-toggle="tab" href="#no-publicadas" role="tab">No publicadas</a>
								</li>
							</ul>
						</div>

						<div class="card-body">
							<div class="tab-content" id="custom-tabs-five-tabContent">
								<div class="tab-pane fade show active" id="publicadas" role="tabpanel">
									<div class="overlay-wrapper py-5">
										<div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
											<div class="text-bold pt-2">Cargando...</div>
										</div>
										<div class="tabla">
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="no-publicadas" role="tabpanel">
									<div class="overlay-wrapper py-5">
										<div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
											<div class="text-bold pt-2">Cargando...</div>
										</div>
										<div class="tabla">
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
		let $tabs = $('#portadas a')
		let $titulo = $('#tit-portadas')
		let nomTab = 'Portadas';

		$tabs.click(function() {
			window.location.hash = this.hash;
			manageHashTab($tabs, $titulo, nomTab);
		});

		// $(window).on('hashchange', function() {
		// 	manageHashTab(tabs, titulo, nomTab);
		// });


		if (window.location.hash == '') {
			window.location.hash = $tabs[0].hash;
			
		}
		manageHashTab($tabs, $titulo, nomTab);
		// 		$(window).resize(function() {
		// $('.table').fnAdjustColumnSizing();
		// });

	}
</script>
