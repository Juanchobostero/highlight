<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/productos_ofertas/_headerProductosOfertas'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<button class="btn btn-sm bg-gradient-primary mb-3" onclick="cargarForm('<?= base_url('frmNuevaOferta') ?>', 'large', 'modal-large')">
				<i class="fas fa-plus fa-fw"></i> Nueva
			</button>
			<div class="card card-outline card-info">
				<div class="card-body">
					<?php $this->load->view('admin/productos_ofertas/_tblProductosOfertas') ?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section><!-- /.content -->
</div>

<?php $this->load->view('admin/components/footer'); ?>

<script>
	formatoTabla('table');
</script>
