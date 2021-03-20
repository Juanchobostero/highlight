<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/productos_ofertas/_headerProductosOfertas'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<button class="btn btn-sm bg-gradient-primary mb-3" onclick="cargarForm('<?= base_url('frmNuevaOfertaIndividual') ?>', 'large', 'modal-large')">
				<i class="fas fa-plus fa-fw"></i> Oferta individual
			</button>
			<button class="btn btn-sm bg-gradient-primary mb-3" onclick="cargarForm('<?= base_url('frmNuevaOfertaPorSubcategoria') ?>', 'large', 'modal-large')">
				<i class="fas fa-plus fa-fw"></i> Oferta por subcategoría
			</button>
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-tabs">
						<div class="card-header p-0 pt-2">
							<ul class="nav nav-tabs" id="ofertas" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#individuales" role="tab">Individuales</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#subcategorias" role="tab">Por subcategorías</a>
								</li>
							</ul>
						</div>

						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="individuales" role="tabpanel">
									<div class="overlay-wrapper py-5">
										<div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
											<div class="text-bold pt-2">Cargando...</div>
										</div>
										<div id="tabla-individuales">
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="subcategorias" role="tabpanel">
									<div class="overlay-wrapper py-5">
										<div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
											<div class="text-bold pt-2">Cargando...</div>
										</div>
										<div id="tabla-subcategorias">
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
		let $tabs = $('#ofertas a')
		let $titulo = $('#tit-ofertas')
		let nomTab = 'Ofertas';

		$tabs.click(function() {
			window.location.hash = this.hash;
			manageHashTab($tabs, $titulo, nomTab);
		});

		if (window.location.hash == '') {
			window.location.hash = $tabs[0].hash;
		}
		manageHashTab($tabs, $titulo, nomTab);
	}

	function formatoFecha(fecha) {
		let parts = fecha.split('-');
		return [parts[2], parts[1], parts[0]].join('/');
	}

	function duracionOferta() {
		let fechaInicio = $('#fecha_inicio').val();
		let fechaFin = $('#fecha_fin').val();
		let comienza = 'comenzó'
		let finaliza = '';

		if (fechaFin != '') {
			finaliza = ' y finaliza el ' + formatoFecha(fechaFin) + ' a las 23:59 hs.';
		}
		if (fechaInicio > fechaHoy()) {
			comienza = 'comienza';
		}
		$('#caducidad').text('La oferta ' + comienza + ' el ' + formatoFecha(fechaInicio) + ' a las 0 hs.' + finaliza);
	}
</script>
