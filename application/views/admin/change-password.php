<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Change Password</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/dashboard' ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/edit-profile' ?>">Account Settings</a></div>
        <div class="breadcrumb-item">Change Password</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">
        Hi, <?php echo $admin['first_name'].' '.$admin['last_name']; ?>
      </h2>
      <p class="section-lead">
        You can change your account's password on this page.
      </p>

      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-7">
          <div class="card">
          </script>
          <form method="post" action="<?php echo base_url(); ?>admin/change-password">
            <div class="card-header">
              <h4>Change Password</h4>
            </div>
            <div class="card-body" style="padding-bottom: 0;">
              <div class="row">
                <div class="form-group col-md-12 col-12">
                  <label>Current Password</label>
                  <input type="password" name="current_password" class="form-control <?php if(!empty(form_error('current_password'))){echo 'is-invalid';} ?>" placeholder="Enter your current password">
                  <div class="invalid-feedback">
                    <?php if(!empty(form_error('current_password'))){echo form_error('current_password');} ?>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12 col-12">
                  <label>New Password</label>
                  <input type="password" name="new_password" class="form-control pwstrength <?php if(!empty(form_error('new_password'))){echo 'is-invalid';} ?>" data-indicator="pwindicator" placeholder="Enter your new password">
                  <div class="invalid-feedback">
                    <?php if(!empty(form_error('new_password'))){echo form_error('new_password');} ?>
                  </div>
                  <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12 col-12">
                  <label>Confirm Password</label>
                  <input type="password" name="confirm_password" class="form-control <?php if(!empty(form_error('confirm_password'))){echo 'is-invalid';} ?>" placeholder="Enter new password again">
                  <div class="invalid-feedback">
                    <?php if(!empty(form_error('confirm_password'))){echo form_error('confirm_password');} ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-center">
              <button type="submit" name="updatePassword" value="Update" class="btn btn-primary">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
