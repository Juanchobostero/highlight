<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/productos_pausados/_headerProductosPausados'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card card-outline card-info">
				<div class="card-body">
					<?php $this->load->view('admin/productos_pausados/_tblProductosPausados') ?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section><!-- /.content -->
</div>

<?php $this->load->view('admin/components/footer'); ?>

<script>
	formatoTabla('tblProductosPausados');
</script>
