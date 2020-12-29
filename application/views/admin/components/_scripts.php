		<!-- REQUIRED SCRIPTS -->
		<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
		<?php if ($log) : ?>
			<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
			<script src="<?= base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
			<script src="<?= base_url('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js'); ?>"></script>
			<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
			<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
			<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js'); ?>"></script>
			<script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js'); ?>"></script>
			<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js'); ?>"></script>
			<script src="<?= base_url('assets/plugins/summernote/summernote-bs4.min.js'); ?>"></script>
			<script src="<?= base_url('assets/plugins/summernote/lang/summernote-es-ES.min.js'); ?>"></script>
		<?php endif; ?>
		<script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
		<script src="<?= base_url('assets/js/admin/adminlte.min.js'); ?>"></script>
		<script src="<?= base_url('assets/js/admin/index.js') ?>"></script>

		<!-- Modal chico -->
		<div class="modal fade" id="small" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" id="modal-small">
					<!-- Contenido modal -->
				</div>
			</div>
		</div>

		<!-- Modal grande-->
		<div class="modal fade" id="large" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content" id="modal-large">
					<!-- Contenido modal -->
				</div>
			</div>
		</div>

		<!-- Modal extra grande-->
		<div class="modal fade" id="extra-large" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-xl">
				<div class="modal-content" id="modal-extra-large">
					<!-- Contenido modal -->
				</div>
			</div>
		</div>
		</body>

		</html>
