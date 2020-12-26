<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/inventario/_headerInventario'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6 col-12">
					<!-- small card -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?= $inventario->total_productos; ?></h3>
							<p>Total de productos</p>
						</div>
						<div class="icon">
							<i class="fab fa-linode"></i>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-12">
					<!-- small card -->
					<div class="small-box bg-lightblue">
						<div class="inner">
							<h3>$ <?= number_format($inventario->total_costo, 0, ',', '.'); ?></h3>
							<p>Costo</p>
						</div>
						<div class="icon">
							<i class="fas fa-dollar-sign"></i>
						</div>
					</div>
				</div>
			</div>
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
	// window.onload = function() {
	// 	let $tabs = $('#productos a')
	// 	let $titulo = $('#tit-productos')
	// 	let nomTab = 'Productos';

	// 	$tabs.click(function() {
	// 		window.location.hash = this.hash;
	// 		manageHashTab($tabs, $titulo, nomTab);
	// 	});

	// 	if (window.location.hash == '') {
	// 		window.location.hash = $tabs[0].hash;
	// 	}
	// 	manageHashTab($tabs, $titulo, nomTab);
	// }
</script>
