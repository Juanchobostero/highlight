<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/categorias/_headerCategorias');?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<button class="btn btn-sm bg-gradient-primary mb-3" onclick="cargarForm('<?= base_url('frmNuevaCategoria') ?>', 'small', 'modal-small')">
				<i class="fas fa-plus fa-fw"></i> Nueva categoría
			</button>
			<button class="btn btn-sm bg-gradient-primary mb-3" onclick="cargarForm('<?= base_url('frmNuevaSubcategoria') ?>', 'small', 'modal-small')">
				<i class="fas fa-plus fa-fw"></i> Nueva subcategoría
			</button>
			<div class="row">
				<div class="col-12">
					<div class="card card-primary card-tabs">
						<div class="card-header p-0 pt-2">
							<ul class="nav nav-tabs" id="categoria" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#categorias" role="tab">Categorías</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#subcategorias" role="tab">Subcategorías</a>
								</li>
							</ul>
						</div>

						<div class="card-body">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="categorias" role="tabpanel">
									<div class="overlay-wrapper py-5">
										<div class="overlay dark"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
											<div class="text-bold pt-2">Cargando...</div>
										</div>
										<div id="tabla-categorias">
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
		let $tabs = $('#categoria a')
		let $titulo = $('#tit-categorias')
		let nomTab = 'Categorías y subcategorías';

		$tabs.click(function() {
			window.location.hash = this.hash;
			manageHashTab($tabs, $titulo, nomTab);
		});

		if (window.location.hash == '') {
			window.location.hash = $tabs[0].hash;
			
		}
		manageHashTab($tabs, $titulo, nomTab);
		formatoTabla('tblcategorias');
	}
</script>
