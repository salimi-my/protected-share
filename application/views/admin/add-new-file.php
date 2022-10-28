<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Add New File</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/dashboard' ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/all-admin' ?>">Administrator</a></div>
        <div class="breadcrumb-item">Add New File</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Hi, <?php echo $admin['first_name'].' '.$admin['last_name']; ?></h2>
      <p class="section-lead">
        Upload file for sharing.
      </p>

      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-6">
          <div class="card card-primary">
            <form id="add-new-file-form" method="post" enctype="multipart/form-data">
              <div class="card-header">
                <h4>Upload File</h4>
              </div>
              <div class="card-body" style="padding-bottom: 0;">
                <div class="row">
                  <div class="form-group col-md-12 col-12">
                    <label>File Name</label>
                    <input id="file_name" type="text" name="file_name" class="form-control">
                    <div id="file_name_error" class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12 col-12">
                    <label>File</label>
                    <div class="custom-file">
                      <input id="file" name="file" type="file" value="" class="custom-file-input mouse-pointer">
                      <label id="file_label" class="custom-file-label" for="selected_file">Choose file</label>
                    </div>
                    <div id="file_error" class="invalid-feedback"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-7 col-12">
                    <label>Password</label>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Click Generate Password to reset password." value="" readonly="readonly" style="background-color: #ffffff;">
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
                <button id="add-new-file-submit" type="submit" name="create-new-admin-submit" value="add-new" class="btn btn-primary">Submit File</button>
                <button id="add-new-file-submitting" type="button" class="btn btn-primary" style="display: none;">
                  <i class="fas fa-spinner fa-pulse"></i> Uploading...
                </button>
                <button id="add-new-file-submitted" type="button" class="btn btn-primary" style="display: none;">
                  <i class="fas fa-check-circle"></i> Uploaded
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
