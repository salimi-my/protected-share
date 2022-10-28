<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="<?php echo base_url().'admin/all-files' ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Edit File</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/dashboard' ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/all-files' ?>">Administrator</a></div>
        <div class="breadcrumb-item">Edit File</div>
      </div>
    </div>
    <div class="section-body">
      <form id="edit-file-form" method="post" action="<?php echo base_url().'admin/edit-file/'.$file['hash']; ?>">
        <div class="row mt-sm-4">
          <div class="col-12 col-md-12 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4>File Information</h4>
              </div>
              <div class="card-body" style="padding-bottom: 0;">
                <div class="form-divider">
                  Personal Detail
                </div>
                <div class="row">
                  <div class="form-group col-md-12 col-12">
                    <label>File Name</label>
                    <input type="text" name="file_name" class="form-control <?php echo !empty(form_error('file_name')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($file['file_name']) ? $file['file_name'] : ''; ?>">
                    <div class="invalid-feedback">
                      <?php if(!empty(form_error('file_name'))){echo form_error('file_name');} ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-center"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-12 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4>File Password</h4>
              </div>
              <div class="card-body" style="padding-bottom: 0;">
                <div class="row text-left">
                  <div class="form-group col-12 col-md-12 col-lg-12 col-xl-7">
                    <label>Password</label>
                    <input id="password" type="password" name="password" class="form-control" value="Click Generate Password to reset password." readonly="readonly" style="background-color: #ffffff;">
                    <div id="password_error" class="invalid-feedback"></div>
                  </div>
                  <div class="form-group col-12 col-md-12 col-lg-12 col-xl-5">
                    <div style="margin-top: 1.9rem;">
                      <button id="show-password" name='show-password' type="button" class="btn btn-secondary" style="margin-right: 6px;"><i class="far fa-eye"></i> Show</button>
                      <button id="hide-password" name='hide-password' type="button" class="btn btn-secondary" style="display: none; margin-right: 6px;"><i class="far fa-eye-slash"></i> Hide</button>
                      <button id="generate-password" name='generate-password' type="button" class="btn btn-secondary" style="margin-left: 6px;">Generate Password</button>
                    </div>
                  </div>
                  <input type="hidden" id="reset_password" name="reset_password" value="0">
                </div>
              </div>
              <div class="card-footer text-center"></div>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-12 col-md-12 col-lg-6">
            <button id="edit-file-submit" type="submit" name="updateFile" value="Update" class="btn btn-primary">Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
