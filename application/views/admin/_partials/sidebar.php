<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?php echo base_url(); ?>admin">PROTECTED SHARE</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo base_url(); ?>admin">PS</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="<?php echo $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>admin/dashboard"><i class="fas fa-desktop"></i> <span>Dashboard</span></a></li>

      <li class="menu-header">File Sharing</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'all-files' || $this->uri->segment(2) == 'add-new-file' ? 'active' : ''; ?>">
        <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-folder-open"></i> <span>Files</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'all-files' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>admin/all-files">All Files</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'add-new-file' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>admin/add-new-file">Add New</a></li>
        </ul>
      </li>

      <li class="menu-header">Administration</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'all-admin' || $this->uri->segment(2) == 'create-new-admin' || $this->uri->segment(2) == 'admin-view-profile' || $this->uri->segment(2) == 'admin-edit-profile' ? 'active' : ''; ?>">
        <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user-tie"></i> <span>Administrator</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'all-admin' || $this->uri->segment(2) == 'admin-view-profile' || $this->uri->segment(2) == 'admin-edit-profile' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?php echo base_url(); ?>admin/all-admin">All Admin</a>
          </li>
          <li class="<?php echo $this->uri->segment(2) == 'create-new-admin' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>admin/create-new-admin">Create New</a></li>
        </ul>
      </li>

      <li class="menu-header">My Account</li>
      <li class="dropdown <?php echo $this->uri->segment(2) == 'edit-profile' || $this->uri->segment(2) == 'change-password' ? 'active' : ''; ?>">
        <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i> <span>Settings</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo $this->uri->segment(2) == 'edit-profile' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>admin/edit-profile">Edit Profile</a></li>
          <li class="<?php echo $this->uri->segment(2) == 'change-password' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>admin/change-password">Change Password</a></li>
        </ul>
      </li>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="<?php echo base_url().'admin/logout'; ?>" class="btn btn-primary btn-lg btn-block">
        Sign Out&emsp; <i class="fas fa-sign-out-alt"></i>
      </a>
    </div>
  </aside>
</div>
