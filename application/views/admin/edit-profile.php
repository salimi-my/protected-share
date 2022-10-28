<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Profile</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/dashboard' ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/edit-profile' ?>">Account Settings</a></div>
        <div class="breadcrumb-item">Edit Profile</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Hi, <?php echo $admin['first_name'].' '.$admin['last_name']; ?></h2>
      <p class="section-lead">
        You can change information about yourself on this page.
      </p>

      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
          <div class="card profile-widget">
            <div class="profile-widget-header">
              <div class="avatar-picture rounded-circle profile-widget-picture" style="background-image: url('<?php echo !empty($admin['picture']) ? base_url().'uploads/profile_picture/'.$admin['picture'] : base_url().'assets/img/avatar/avatar-1.png'; ?>');"></div>
              <div class="profile-widget-items">
                <div class="profile-widget-item">
                  <div class="profile-widget-item-label"><i class="fas fa-phone text-success" style="font-size: 16px;"></i></div>
                  <div class="profile-widget-item-value"><?php echo !empty($admin['phone']) ? $admin['phone'] : 'Not set'; ?></div>
                </div>
                <div class="profile-widget-item">
                  <div class="profile-widget-item-label"><i class="fas fa-envelope text-info" style="font-size: 16px;"></i></div>
                  <div class="profile-widget-item-value"><?php echo !empty($admin['email']) ? $admin['email'] : 'Not set'; ?></div>
                </div>
              </div>
            </div>
            <div class="profile-widget-description">
              <div class="profile-widget-name">
                <?php echo $admin['first_name'].' '.$admin['last_name']; ?>
                <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> <?php echo ucwords($admin['acc_type']); ?></div></div>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
              <form id="edit-profile-form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/edit-profile">
                <div class="card-header">
                  <h4>Edit Profile</h4>
                </div>
                <div class="card-body" style="padding-bottom: 0;">
                  <div class="form-divider">
                    Profile Picture
                  </div>
                  <div class="row justify-content-center">
                    <div class="form-group col-md-3 col-6" style="max-width: none; margin-bottom: 0;">
                      <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail img-circle img-raised">
                          <?php
                          $change = false;
                          if(!empty($admin['picture'])){
                            $httpPos = strpos($admin['picture'], 'http');
                            if($httpPos === false){
                              $image = $this->config->item('upload_url').'profile_picture/'.$admin['picture'];
                            }else{
                              $image = $admin['picture'];
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
                      <input type="text" name="first_name" class="form-control <?php echo !empty(form_error('first_name')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($admin['first_name']) ? $admin['first_name'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php if(!empty(form_error('first_name'))){echo form_error('first_name');} ?>
                      </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>Last Name</label>
                      <input type="text" name="last_name" class="form-control <?php echo !empty(form_error('last_name')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($admin['last_name']) ? $admin['last_name'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php if(!empty(form_error('last_name'))){echo form_error('last_name');} ?>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6 col-12">
                      <label>Email</label>
                      <input type="email" name="email" class="form-control <?php echo !empty(form_error('email')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($admin['email']) ? $admin['email'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php if(!empty(form_error('email'))){echo form_error('email');} ?>
                      </div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>Phone</label>
                      <input id="phone" type="tel" name="phone" class="form-control phone <?php echo !empty(form_error('phone')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($admin['phone']) ? $admin['phone'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php if(!empty(form_error('phone'))){echo form_error('phone');} ?>
                      </div>
                    </div>
                    <div class="form-group col-md-12 col-12">
                      <label>Username</label>
                      <input type="text" name="username" class="form-control <?php echo !empty(form_error('username')) ? 'is-invalid' : ''; ?>" value="<?php echo !empty($admin['username']) ? $admin['username'] : ''; ?>">
                      <div class="invalid-feedback">
                        <?php if(!empty(form_error('username'))){echo form_error('username');} ?>
                      </div>
                    </div>
                    <input type="hidden" name="acc_type" value="<?php echo $admin['acc_type']; ?>">
                  </div>
                </div>
                <div class="card-footer text-center">
                  <button id="edit-profile-submit" type="submit" name="updateProfile" value="Update" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php $this->load->view('admin/_partials/footer'); ?>
