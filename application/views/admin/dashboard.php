<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-download"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Downloads</h4>
            </div>
            <div class="card-body">
              <?php echo $total_downloads; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Most Download File</h4>
            </div>
            <div class="card-body">
              <?php echo $most_download->file_name; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Most Download Admin</h4>
            </div>
            <div class="card-body">
              <?php echo $most_download_admin;; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h4>Top 5 Most Downloaded</h4>
          </div>
          <div class="card-body">
            <div class="owl-carousel owl-theme" id="downloaded-carousel">
              <?php foreach($top_5 as $key => $value){ ?>
                <div>
                  <div class="product-item pb-3">
                    <div class="product-image">
                      <i class="fas fa-file fa-5x text-primary share-file-icon-lg"></i>
                    </div>
                    <div class="product-details">
                      <div class="product-name"><?php echo $value->file_name; ?></div>
                      <div class="text-muted text-small"><?php echo $value->downloaded; ?> Downloads</div>
                      <div class="product-cta">
                        <a href="<?php echo base_url().'share/file/'.$value->hash ?>" class="btn btn-primary" target="_blank"><i class="fas fa-link"></i> View</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php $this->load->view('admin/_partials/footer'); ?>
