<?php
if (!defined('BASEPATH'))    exit('No direct script access allowed');
/*
* Admin_init_elements separate view by elements
*/
class Admin_init_elements {

  var $CI;
  var $data;

  function __construct() {
    $this->CI = & get_instance();
  }

  /*
  * Check admin login status
  */
  function is_admin_loggedin() {
    if (!$this->CI->session->userdata('isAdminLoggedIn') && $this->CI->session->userdata('adminId') == '') {
      redirect('admin/login');
    }
  }

  /*
  * Check admin login status
  */
  function is_admin_loggedin_check() {
    $result = 1;
    if (!$this->CI->session->userdata('isAdminLoggedIn') && $this->CI->session->userdata('adminId') == '') {
      $result = 0;
    }
    return $result;
  }
}
