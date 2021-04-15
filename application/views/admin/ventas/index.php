<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/ventas/_headerVentas'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-tabs">
						<div class="card-header p-0 pt-2">
							<ul class="nav nav-tabs" id="ventas" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#nuevas" role="tab">Nuevas
										<span class="badge badge-danger notif-ventas"></span>
									</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#confirmadas" role="tab">Confirmadas</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#entregadas" role="tab">Entregadas</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#canceladas" role="tab">Canceladas</a>
								</li>
							</ul>
						</div>

						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="nuevas" role="tabpanel">
									<div class="overlay-wrapper py-5">
										<div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
											<div class="text-bold pt-2">Cargando...</div>
										</div>
										<div id="tabla-nuevas">
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="confirmadas" role="tabpanel">
									<div class="overlay-wrapper py-5">
										<div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
											<div class="text-bold pt-2">Cargando...</div>
										</div>
										<div id="tabla-confirmadas">
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="entregadas" role="tabpanel">
									<div class="overlay-wrapper py-5">
										<div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
											<div class="text-bold pt-2">Cargando...</div>
										</div>
										<div id="tabla-entregadas">
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="canceladas" role="tabpanel">
									<div class="overlay-wrapper py-5">
										<div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
											<div class="text-bold pt-2">Cargando...</div>
										</div>
										<div id="tabla-canceladas">
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
		let $tabs = $('#ventas a')
		let $titulo = $('#tit-ventas')
		let nomTab = 'Ventas';

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
