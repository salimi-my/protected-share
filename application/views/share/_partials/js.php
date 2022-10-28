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
if ($this->uri->segment(2) == "file") { ?>
  <script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
<?php } ?>

<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
</body>
</html>
