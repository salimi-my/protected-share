<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <div class="section-header-back">
        <a href="<?php echo base_url().'admin/all-admin' ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
      </div>
      <h1>Edit Profile</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/dashboard' ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/all-admin' ?>">Administrator</a></div>
        <div class="breadcrumb-item">Edit Profile</div>
      </div>
    </div>
    <div class="section-body">
      <form id="edit-profile-form" method="post" enctype="multipart/form-data" action="<?php echo base_url().'admin/admin-edit-profile/'.$profile['hash']; ?>">
        <div class="row mt-sm-4">
          <div class="col-12 col-md-12 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4>Account Information</h4>
              </div>
              <div class="card-body" style="padding-bottom: 0;">
                <div class="form-divider">
                  Profile Picture
                </div>
                <div class="row justify-content-center">
                  <div class="form-group col-md-3 col-6" style="max-width: none; margin-bottom: 38px;">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail img-circle img-raised">
                        <?php
                        $change = false;
                        if(!empty($profile['picture'])){
                          $httpPos = strpos($profile['picture'], 'http');
                          if($httpPos === false){
                            $image = $this->config->item('upload_url').'profile_picture/'.$profile['picture'];
                          }else{
                            $image = $profile['picture'];
                          }
                          $change = true;
                        }else{
                          $image = $this->config->item('public_url').'img/avatar/avatar-1.png';
                        }
                        ?>
                        <img src="<?php echo $image; ?>" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div>
                      <div>
                        <span class="btn btn-raised btn-round btn-secondary btn-file" style="margin: 10px 0;">
                          <?php
                          if($change == true){
                            echo '<span class="fileinput-new mouse-pointer">Change Photo</span>';
                          }else{
                            echo '<span class="fileinput-new mouse-pointer">Add Photo</span>';
                          }
                          ?>
                          <span class="fileinput-exists mouse-pointer"><i class="fas fa-undo"></i> Change</span>
                          <input class="mouse-pointer" type="file" name="picture" />
                        </span>
                        <br />
                        <a href="#" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                      </div>
                    </div>
                  </div>
                  <div class="invalid-feedback text-center" style="display: block;">
                    <?php if(!empty(form_error('file'))){echo form_error('file');} ?>
                  </div>
                </div>
                <div class="form-divider">
                  Personal Detail
                </div>
                <div class="row">
                  <div class="form-group col-md-6 col-12">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control <?php echo !empty(form_error('first_name')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($profile['first_name']) ? $profile['first_name'] : ''; ?>">
                    <div class="invalid-feedback">
                      <?php if(!empty(form_error('first_name'))){echo form_error('first_name');} ?>
                    </div>
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control <?php echo !empty(form_error('last_name')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($profile['last_name']) ? $profile['last_name'] : ''; ?>">
                    <div class="invalid-feedback">
                      <?php if(!empty(form_error('last_name'))){echo form_error('last_name');} ?>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6 col-12">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control <?php echo !empty(form_error('email')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($profile['email']) ? $profile['email'] : ''; ?>">
                    <div class="invalid-feedback">
                      <?php if(!empty(form_error('email'))){echo form_error('email');} ?>
                    </div>
                  </div>
                  <div class="form-group col-md-6 col-12">
                    <label>Phone</label>
                    <input id="phone" type="tel" name="phone" class="form-control phone <?php echo !empty(form_error('phone')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($profile['phone']) ? $profile['phone'] : ''; ?>">
                    <div class="invalid-feedback">
                      <?php if(!empty(form_error('phone'))){echo form_error('phone');} ?>
                    </div>
                  </div>
                  <div class="form-group col-md-12 col-12">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control <?php echo !empty(form_error('username')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($profile['username']) ? $profile['username'] : ''; ?>">
                    <div class="invalid-feedback">
                      <?php if(!empty(form_error('username'))){echo form_error('username');} ?>
                    </div>
                  </div>
                  <input type="hidden" name="acc_type" value="<?php echo $profile['acc_type']; ?>">
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
                <h4>Account Password</h4>
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
            <button id="edit-profile-submit" type="submit" name="updateProfile" value="Update" class="btn btn-primary">Save Changes</button>
          </div>
        </div>
      </form>
    </div>
  </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
