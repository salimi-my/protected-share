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
      <h1>View Profile</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/dashboard' ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/all-admin' ?>">Administrator</a></div>
        <div class="breadcrumb-item">View Profile</div>
      </div>
    </div>
    <div class="section-body">
      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-6">
          <div class="card profile-widget">
            <div class="profile-widget-header">
              <div class="avatar-picture rounded-circle profile-widget-picture" style="background-image: url('<?php echo !empty($profile['picture']) ? base_url().'uploads/profile_picture/'.$profile['picture'] : base_url().'assets/img/avatar/avatar-1.png'; ?>');"></div>
              <div class="profile-widget-items">
                <div class="profile-widget-item">
                  <div class="profile-widget-item-label"><i class="fas fa-phone text-success" style="font-size: 16px;"></i></div>
                  <div class="profile-widget-item-value"><?php echo !empty($profile['phone']) ? $profile['phone'] : 'Not set'; ?></div>
                </div>
                <div class="profile-widget-item">
                  <div class="profile-widget-item-label"><i class="fas fa-envelope text-info" style="font-size: 16px;"></i></div>
                  <div class="profile-widget-item-value"><?php echo !empty($profile['email']) ? $profile['email'] : 'Not set'; ?></div>
                </div>
              </div>
            </div>
            <div class="profile-widget-description">
              <div class="profile-widget-name">
                <?php echo $profile['first_name'].' '.$profile['last_name']; ?>
                <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> <?php echo ucwords($profile['acc_type']); ?></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php $this->load->view('admin/_partials/footer'); ?>
