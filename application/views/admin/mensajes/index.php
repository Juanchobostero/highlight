<?php $this->load->view('admin/components/header'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php $this->load->view('admin/mensajes/_headerMensajes'); ?>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card card-primary card-outline">
					<div class="card-header">
						<h3 class="card-title">Inbox</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<div class="table-responsive mailbox-messages">
							<?php $this->load->view('admin/mensajes/_tblMensajes'); ?>

						</div>
						<!-- /.mail-box-messages -->
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section><!-- /.content -->
</div>

<?php $this->load->view('admin/components/footer'); ?>
