<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              PROTECTED SHARE
            </div>

            <div class="card card-primary shadow">
              <div class="card-header"><h4>Admin Login</h4></div>

              <div class="card-body">

                <form id="login_form" action="<?php echo base_url().'admin/login'; ?>" method="post" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Username or Email</label>
                    <input id="username_email" type="username_email" class="form-control<?php if(!empty(form_error('username_email'))){echo ' is-invalid';} ?>" name="username_email" tabindex="1" required autofocus>
                    <?php echo form_error('username_email', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control<?php if(!empty(form_error('password'))){echo ' is-invalid';} ?>" name="password" tabindex="2" required>
                    <?php echo form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="rememberMe" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="hidden" name="form_submitted" value="login">
                    <button id="login_submit" type="submit" name="loginSubmit" value="Login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>

              </div>
            </div>

            <div class="simple-footer">
              &copy; <?php echo date("Y"); ?> Protected Share All Rights Reserved.
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <?php $this->load->view('admin/_partials/js'); ?>
