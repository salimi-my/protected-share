<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Administrators</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/dashboard' ?>">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="<?php echo base_url().'admin/all-admin' ?>">Administrator</a></div>
        <div class="breadcrumb-item">All Admin</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Hi, <?php echo $admin['first_name'].' '.$admin['last_name']; ?></h2>
      <p class="section-lead">
        Table below shows all available admin accounts.
      </p>

      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <a href="<?php echo base_url().'admin/create-new-admin'; ?>">
                <button type="button" class="btn btn-outline-primary" style="padding: 2px 11px;">Create New Admin</button>
              </a>
              <button id="delete-button" type="button" class="btn btn-outline-primary" style="margin-left: 10px; display: none; padding: 2px 11px;">Delete Selected</button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover table-striped" id="all-admin-table" style="width: 100%;">
                  <thead>
                    <tr>
                      <th class="text-center">
                        <div class="custom-checkbox custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                          <label for="checkbox-all" class="custom-control-label mouse-pointer">&nbsp;</label>
                        </div>
                      </th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th class="text-center">Role</th>
                    </tr>
                  </thead>
                  <tbody id="all-admin-table-body"></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade" tabindex="-1" role="dialog" id="delete_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <form id="delete_form">
          <div class="modal-header">
            <h5 class="modal-title">Are you sure ?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Do you really want to delete these selected account(s) ?
            <div id="selected_username" style="margin-top: 10px;"></div>
            <input id="user_table" name="user_table" type="hidden" value="admin">
            <input id="selected_hash" name="selected_hash" type="hidden" value="">
            <input id="loggedin_hash" name="loggedin_hash" type="hidden" value="<?php echo $admin['hash']; ?>">
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
            <button id="confirm_delete" name="confirm_submit" type="submit" class="btn btn-danger">Delete</button>
            <button id="delete_loading" type="button" style="display: none;" class="btn btn-danger">
              <i class="fas fa-spinner fa-pulse"></i> Deleting...
            </button>
            <button id="deleted" type="button" style="display: none;" class="btn btn-danger">
              <i class="fas fa-check-circle"></i> Deleted
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
