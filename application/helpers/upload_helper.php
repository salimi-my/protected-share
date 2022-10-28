<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * File upload helper function
 */
if(! function_exists('upload')){
	function upload($field_name = '', $upload_path = '', $allowed_type = '', $file_name = '', $thumb = FALSE, $thumb_path = '', $thumb_width = '', $thumb_height = '', $maintain_ratio = ''){
		$ci =& get_instance();
		$config['upload_path'] = $upload_path;
		if($allowed_type == ''){
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
		}else{
			$config['allowed_types'] = $allowed_type;
		}
		if($file_name == ''){
			$config['file_name'] = $_FILES[$field_name]['name'];
		}else{
			$config['file_name'] = $file_name;
		}
		$ci->load->library('upload',$config);
		$ci->upload->initialize($config);

		if($ci->upload->do_upload($field_name)){
			$upload_data = $ci->upload->data();
			if($thumb == TRUE){
				$thumb_config['image_library'] = 'gd2';
				$thumb_config['source_image'] = $upload_path.$upload_data['file_name'];
				$thumb_config['new_image'] = $thumb_path.$upload_data['file_name'];
				$thumb_config['maintain_ratio'] = ($maintain_ratio != '')?$maintain_ratio:FALSE;
				$thumb_config['width'] = $thumb_width;
				$thumb_config['height'] = $thumb_height;
				$ci->load->library('image_lib',$thumb_config);
				$ci->image_lib->initialize($thumb_config);
				$ci->image_lib->resize();
				$ci->image_lib->clear();
				return $upload_data;
			}else{
				return $upload_data;
			}
		}else{
			return false;
		}
	}
}

/*
 * Image thumbnail creation helper function
 */
if(! function_exists('create_thumb')){
	function create_thumb($source_image = '', $file_name = '', $thumb_path = '', $thumb_width = '', $thumb_height = '', $maintain_ratio = TRUE){
		$ci =& get_instance();

		$thumb_config['image_library'] = 'gd2';
		$thumb_config['source_image'] = $source_image;
		$thumb_config['new_image'] = $thumb_path.$file_name;
		$thumb_config['maintain_ratio'] = $maintain_ratio;
		$thumb_config['width'] = $thumb_width;
		$thumb_config['height'] = $thumb_height;
		$ci->load->library('image_lib',$thumb_config);
		$ci->image_lib->initialize($thumb_config);
		if($ci->image_lib->resize()){
			$ci->image_lib->clear();
			return true;
		}else{
			return false;
		}
	}
}
?>
