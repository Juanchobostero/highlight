<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/productos_destacados/_headerProductosDestacados'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="card card-outline card-info">
				<div class="card-body">
					<?php $this->load->view('admin/productos_destacados/_tblProductosDestacados') ?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section><!-- /.content -->
</div>

<?php $this->load->view('admin/components/footer'); ?>

<script>
	formatoTabla('table');
</script>
