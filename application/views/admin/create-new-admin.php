<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Create New Admin</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/dashboard' ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/all-admin' ?>">Administrator</a></div>
        <div class="breadcrumb-item">Create New Admin</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Hi, <?php echo $admin['first_name'].' '.$admin['last_name']; ?></h2>
      <p class="section-lead">
        Create a brand new admin and add them to this system.
      </p>

      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-7">
          <div class="card card-primary">
            <form id="create-new-admin-form" method="post">
              <div class="card-header">
                <h4>Create New Admin</h4>
              </div>
              <div class="card-body" style="padding-bottom: 0;">
                <div class="row">
                  <div class="form-group col-md-6 col-12">
                    <label>First Name</label>
                    <input id="first_name" type="text" name="first_name" class="form-control">
                    <div id="first_name_error" class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label>Last Name</label>
                    <input id="last_name" type="text" name="last_name" class="form-control">
                    <div id="last_name_error" class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6 col-12">
                    <label>Username</label>
                    <input id="username" type="text" name="username" class="form-control username">
                    <div id="username_error" class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label>Phone</label>
                    <input id="phone" type="tel" name="phone" class="form-control phone">
                    <div id="phone_error" class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12 col-12">
                    <label>Email</label>
                    <input id="email" type="email" name="email" class="form-control">
                    <div id="email_error" class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-7 col-12">
                    <label>Password</label>
                    <input id="password" type="password" name="password" class="form-control" value="" readonly="readonly" style="background-color: #ffffff;">
                    <div id="password_error" class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-md-5 col-12">
                    <div style="margin-top: 1.9rem;">
                      <button id="show-password" name='show-password' type="button" class="btn btn-secondary" style="margin-right: 6px;"><i class="far fa-eye"></i> Show</button>
                      <button id="hide-password" name='hide-password' type="button" class="btn btn-secondary" style="display: none; margin-right: 6px;"><i class="far fa-eye-slash"></i> Hide</button>
                      <button id="generate-password" name='generate-password' type="button" class="btn btn-secondary" style="margin-left: 6px;">Generate Password</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-center" style="margin-top: 20px;">
                <button id="create-new-admin-submit" type="submit" name="create-new-admin-submit" value="add-new" class="btn btn-primary">Create New Admin</button>
                <button id="create-new-admin-submitting" type="button" class="btn btn-primary" style="display: none;">
                  <i class="fas fa-spinner fa-pulse"></i> Creating...
                </button>
                <button id="create-new-admin-submitted" type="button" class="btn btn-primary" style="display: none;">
                  <i class="fas fa-check-circle"></i> Created
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
