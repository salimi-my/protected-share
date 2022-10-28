<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.timeago.js"></script>

<!-- JS Libraies -->
<?php
if ($this->uri->segment(2) == "" || $this->uri->segment(2) == "dashboard") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
<?php }elseif ($this->uri->segment(2) == "login") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
<?php }elseif ($this->uri->segment(2) == "edit-profile" || $this->uri->segment(2) == "change-password") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/addons/cleave-phone.my.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
<?php }elseif ($this->uri->segment(2) == "create-new-admin") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/addons/cleave-phone.my.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
<?php }elseif ($this->uri->segment(2) == "all-admin") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
<?php }elseif ($this->uri->segment(2) == "admin-edit-profile") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/addons/cleave-phone.my.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<?php }elseif ($this->uri->segment(2) == "add-new-file") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
<?php }elseif ($this->uri->segment(2) == "all-files") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
<?php }elseif ($this->uri->segment(2) == "edit-file") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/addons/cleave-phone.my.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jasny-bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<?php } ?>

<!-- Page Specific JS File -->
<?php
if ($this->uri->segment(2) == "" || $this->uri->segment(2) == "dashboard") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/index.js"></script>
<?php }elseif ($this->uri->segment(2) == "edit-profile" || $this->uri->segment(2) == "admin-edit-profile") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/success-error.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/page/admin-edit-profile.js"></script>
<?php }elseif ($this->uri->segment(2) == "change-password") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/admin-change-password.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/page/success-error.js"></script>
<?php }elseif ($this->uri->segment(2) == "all-admin") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/all-admin.js"></script>
<?php }elseif ($this->uri->segment(2) == "create-new-admin") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/create-new-admin.js"></script>
<?php }elseif ($this->uri->segment(2) == "add-new-file") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/add-new-file.js"></script>
<?php }elseif ($this->uri->segment(2) == "all-files") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/all-files.js"></script>
<?php }elseif ($this->uri->segment(2) == "edit-file") { ?>
  <script src="<?php echo base_url(); ?>assets/js/page/success-error.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/page/edit-file.js"></script>
<?php } ?>

<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
</body>
</html>
