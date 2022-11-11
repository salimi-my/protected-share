<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('share/_partials/header');
?>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              DOWNLOAD FILE
            </div>

            <div class="card card-primary shadow">
              <div class="card-header"><h4>Download File</h4></div>

              <div class="card-body pt-0">

                <form id="file_form" action="<?php echo base_url().'share/file/'.$file->hash; ?>" method="post" class="needs-validation" novalidate="">
                  <?php
                  if(!empty($error_msg)){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    '.$error_msg.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                  }
                  ?>
                  <div class="d-flex justify-content-start">
                    <p class="share-icon-text"><i class="far fa-file share-file-icon"></i> <?php echo $file->file_name; ?></p>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" placeholder="Enter password..." class="form-control<?php if(!empty(form_error('password'))){echo ' is-invalid';} ?>" name="password" tabindex="2">
                    <?php echo form_error('password', '<div class="invalid-feedback">', '</div>'); ?>
                  </div>

                  <div class="form-group">
                    <input type="hidden" name="form_submitted" value="submit">
                    <button id="form_submit" type="submit" name="formSubmit" value="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Submit
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

  <?php $this->load->view('share/_partials/js'); ?>
