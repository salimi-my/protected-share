<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<footer class="main-footer">
  <div class="footer-left">
    &copy; <script>document.write(new Date().getFullYear())</script> Protected Share All Rights Reserved.
  </div>
  <div class="footer-right">
    <!-- Right footer here -->
  </div>
</footer>
</div>
</div>
<?php $this->load->view('admin/_partials/js'); ?>

<?php
if($this->uri->segment(2) == "edit-profile"
|| $this->uri->segment(2) == "change-password"
|| $this->uri->segment(2) == "edit-file"
|| $this->uri->segment(2) == "admin-edit-profile"){
  if(!empty($success_msg)){
    echo '<script>',
    'var message = "'.strip_tags($success_msg).'";',
    'success_swal(message);',
    '</script>';
  }else if(!empty($error_msg)){
    echo '<script>',
    'var message = "'.strip_tags($error_msg).'";',
    'error_swal(message);',
    '</script>';
  }
}
?>

<script>
$(document).ready(function(){
  $("time.timeago").timeago();
});
</script>

<?php if($this->uri->segment(2) == "create-new-admin"){ ?>
  <script>
  $(document).ready(function(){
    $('#create-new-admin-submit').on('click', function(e){
      e.preventDefault();
      $('#create-new-admin-submit').hide();
      $('#create-new-admin-submitting').show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>admin/ajax-new-admin",
        data: $("#create-new-admin-form").serialize(),
        dataType: "JSON",
        success: function(data){
          if(data.result == true){
            $('#create-new-admin-submitting').hide();
            $('#create-new-admin-submitted').show();
            swal({
              title: "Success!",
              text: data.success_message,
              icon: "success",
              button: "Okay!"
            }).then(function() {
              window.location.replace("<?php echo base_url(); ?>admin/all-admin");
            });
          }else{
            $('#create-new-admin-submitting').hide();
            $('#create-new-admin-submit').show();
            if(data.first_name_error != '' || data.last_name_error != '' || data.username_error != ''
            || data.phone_error != '' || data.email_error != '' || data.password_error != ''){
              if(data.first_name_error != ''){
                $('#first_name').addClass('is-invalid');
                $('#first_name_error').html(data.first_name_error);
              }else{
                $('#first_name_error').html('');
                if($('#first_name').hasClass('is-invalid')){
                  $('#first_name').removeClass('is-invalid');
                }
              }
              if(data.last_name_error != ''){
                $('#last_name').addClass('is-invalid');
                $('#last_name_error').html(data.last_name_error);
              }else{
                $('#last_name_error').html('');
                if($('#last_name').hasClass('is-invalid')){
                  $('#last_name').removeClass('is-invalid');
                }
              }
              if(data.username_error != ''){
                $('#username').addClass('is-invalid');
                $('#username_error').html(data.username_error);
              }else{
                $('#username_error').html('');
                if($('#username').hasClass('is-invalid')){
                  $('#username').removeClass('is-invalid');
                }
              }
              if(data.phone_error != ''){
                $('#phone').addClass('is-invalid');
                $('#phone_error').html(data.phone_error);
              }else{
                $('#phone_error').html('');
                if($('#phone').hasClass('is-invalid')){
                  $('#phone').removeClass('is-invalid');
                }
              }
              if(data.email_error != ''){
                $('#email').addClass('is-invalid');
                $('#email_error').html(data.email_error);
              }else{
                $('#email_error').html('');
                if($('#email').hasClass('is-invalid')){
                  $('#email').removeClass('is-invalid');
                }
              }
              if(data.password_error != ''){
                $('#password').addClass('is-invalid');
                $('#password_error').html(data.password_error);
              }else{
                $('#password_error').html('');
                if($('#password').hasClass('is-invalid')){
                  $('#password').removeClass('is-invalid');
                }
              }
            }
            else{
              swal({
                title: "Error!",
                text: data.error_message,
                icon: "error",
                button: "Okay!"
              });
            }
          }
        }
      });
    });
  });
</script>
<?php } ?>

<?php if($this->uri->segment(2) == "all-admin" || $this->uri->segment(2) == "all-files"){ ?>
  <script>
  $(document).ready(function(){
    $('#confirm_delete').on('click', function (e) {
      e.preventDefault();
      $('#confirm_delete').hide();
      $('#delete_loading').show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>admin/delete-selected-row",
        data: $("#delete_form").serialize(),
        dataType: "JSON",
        success: function(data){
          if(data.result == true){
            $('#delete_loading').hide();
            $('#deleted').show();
            $('#delete_modal').modal('hide');
            swal({
              title: "Success!",
              text: data.success_message,
              icon: "success",
              button: "Okay!"
            }).then(function() {
              location.reload();
            });
          }else{
            $('#delete_loading').hide();
            $('#confirm_delete').show();
            $('#delete_modal').modal('hide');
            swal({
              title: "Error!",
              text: data.error_message,
              icon: "error",
              button: "Okay!"
            });
          }
        }
      });
    });
  });
</script>
<?php } ?>

<?php if($this->uri->segment(2) == "add-new-file"){ ?>
  <script>
  $(document).ready(function(){
    $('#add-new-file-submit').on('click', function(e){
      e.preventDefault();
      $('#add-new-file-submit').hide();
      $('#add-new-file-submitting').show();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>admin/ajax-new-file",
        data: new FormData($("#add-new-file-form")[0]),
        processData: false,
        contentType: false,
        success: function(data){
          if(data.result == true){
            $('#add-new-file-submitting').hide();
            $('#add-new-file-submitted').show();
            swal({
              title: "Success!",
              text: data.success_message,
              icon: "success",
              button: "Okay!"
            }).then(function() {
              window.location.replace("<?php echo base_url(); ?>admin/all-files");
            });
          }else{
            $('#add-new-file-submitting').hide();
            $('#add-new-file-submit').show();
            if(data.file_name_error != '' || data.file_error != '' || data.password_error != ''){
              if(data.file_name_error != ''){
                $('#file_name').addClass('is-invalid');
                $('#file_name_error').html(data.file_name_error);
              }else{
                $('#file_name_error').html('');
                if($('#file_name').hasClass('is-invalid')){
                  $('#file_name').removeClass('is-invalid');
                }
              }
              if(data.file_error != ''){
                $('#file').addClass('is-invalid');
                $('#file_error').html(data.file_error);
              }else{
                $('#file_error').html('');
                if($('#file').hasClass('is-invalid')){
                  $('#file').removeClass('is-invalid');
                }
              }
              if(data.password_error != ''){
                $('#password').addClass('is-invalid');
                $('#password_error').html(data.password_error);
              }else{
                $('#password_error').html('');
                if($('#password').hasClass('is-invalid')){
                  $('#password').removeClass('is-invalid');
                }
              }
            }
            else{
              swal({
                title: "Error!",
                text: data.error_message,
                icon: "error",
                button: "Okay!"
              });
            }
          }
        }
      });
    });
  });
</script>
<?php } ?>
