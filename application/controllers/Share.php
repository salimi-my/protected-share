<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Share extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('share_model');
  }

  public function index()
  {
    redirect('admin/login');
  }

  /*
  * Show file
  */
  public function file($hash)
  {
    // redirect admin login if hash empty
    if (empty($hash)) {
      redirect('admin/login');
    }

    $data = array();

    if ($this->input->post('form_submitted')) {
      //form field validation rules
      $this->form_validation->set_rules('password', 'password', 'required');

      //validate submitted form data
      if ($this->form_validation->run() == true) {
        // check whether file exists in the database
        $fileData['hash'] = $hash;
        $fileData['password'] = sha1(sha1(sha1(strip_tags($this->input->post('password')))));
        $checkFile = $this->share_model->check_file($fileData);
        if ($checkFile != false) {
          // download file
          $this->load->helper('download');
          force_download($checkFile->link, NULL);
        } else {
          $data['error_msg'] = 'Wrong password. Please try again.';
        }
      }
    }
    // get file info
    $data['file'] = $this->share_model->get_file($hash);

    $data['title'] = 'Download File';
    $this->load->view('share/file', $data);
  }
}
