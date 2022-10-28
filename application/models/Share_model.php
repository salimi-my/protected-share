<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Share_model extends CI_Model{
  function __construct() {
  }

  function get_file($hash){
    $query = $this->db->get_where('file', array('hash' => $hash));
    if($query->num_rows() > 0) {
      return $query->row();
    }

    return false;
  }

  function check_file($fileData){
    $query = $this->db->from('file')->where(array('hash'=> $fileData['hash'], 'password' => $fileData['password']))->get();
    if($query->num_rows() > 0) {
      $file_info = $query->row();

      $downloaded = $file_info->downloaded + 1;

      $update = $this->db->where('id', $file_info->id)->update('file', array('downloaded' => $downloaded));

      $file_info->link = './shared_file/'.$file_info->file;

      return $file_info;
    }

    return false;
  }
}
