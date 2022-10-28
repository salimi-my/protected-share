<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?php echo !empty($admin['picture']) ? base_url().'uploads/profile_picture/thumb/'.$admin['picture'] : base_url().'assets/img/avatar/avatar-1.png'; ?>" class="avatar-picture-small rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">
                <?php echo !empty($admin['first_name']) ? $admin['first_name'].' '.$admin['last_name'] : 'Noob Man'; ?>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in <time class="timeago" datetime="<?php echo $login_time; ?>"></time></div>
              <a href="<?php echo base_url(); ?>admin/dashboard" class="dropdown-item has-icon">
                <i class="fas fa-chart-line"></i> Dashboard
              </a>
              <a href="<?php echo base_url(); ?>admin/edit-profile" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Edit Profile
              </a>
              <a href="<?php echo base_url(); ?>admin/change-password" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Passwords
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?php echo base_url(); ?>admin/logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
