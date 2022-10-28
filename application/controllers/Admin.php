<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
		parent::__construct();
    $this->load->library('admin_init_elements');
    $this->load->library('form_validation');
    $this->load->model('admin_model');

    //check whether admin ID is available in cookie or session
    $this->load->helper('cookie');
    $rememberAdminId = get_cookie('rememberAdminId');
    if(!empty($rememberAdminId)){
      $this->session->set_userdata('isAdminLoggedIn',TRUE);
      $this->session->set_userdata('adminId',$rememberAdminId);
      $this->session->set_userdata('adminLoggedInTime', date('Y-m-d H:i:s'));
      $this->adminId = $rememberAdminId;
    }elseif($this->session->userdata('isAdminLoggedIn')){
      $this->adminId = $this->session->userdata('adminId');
    }else{
      $this->adminId = '';
    }
  }

	public function index(){
		// load dashboard for logged-in admin, redirect to Login if otherwise
    if($this->adminId){
      redirect('admin/dashboard');
    }else{
      redirect('admin/login');
    }
	}

	/*
  * Admin dashboard
  */
  public function dashboard(){
		//check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $data = array();

		$data['total_downloads'] = $this->admin_model->get_total_downloads();
		$data['most_download'] = $this->admin_model->most_download();
		$data['most_download_admin'] = $this->admin_model->most_download_admin();
		$data['top_5'] = $this->admin_model->top_5();

    //get admin information
    $data['is_login'] = 1;
    $data['admin'] = $this->admin_model->getRows(array('id'=>$this->adminId));
    $data['login_time'] = $this->session->userdata('adminLoggedInTime');
    $data['title'] = 'Dashboard';

    //load dashboard view
    $this->load->view('admin/dashboard', $data);
  }

	/*
  * Admin login
  */
  public function login(){
    //redirect logged in admin to dashboard
    if($this->adminId){
      redirect('admin/dashboard');
    }
    if($this->input->post('form_submitted')){
      //form field validation rules
      $this->form_validation->set_rules('username_email', 'username or email', 'required', array('valid_email' => 'Please enter username or valid email address'));
      $this->form_validation->set_rules('password', 'password', 'required');

      //validate submitted form data
      if ($this->form_validation->run() == true) {
        $username_email = $this->input->post('username_email');
        $column = '';
        if(strpos($username_email, '@') == true){
          $column = 'email';
        }else{
          $column = 'username';
        }
        //check whether user exists in the database
        $con['returnType'] = 'single';
        $con['conditions'] = array(
          $column => $username_email,
          'password' => sha1(sha1(sha1($this->input->post('password'))))
        );
        $checkLogin = $this->admin_model->getRows($con);
        if($checkLogin){
          //if remember me is checked
          if ($this->input->post('rememberMe') == "true") {
            $rememberCookie = array(
              'name' => 'rememberAdminId',
              'value' => $checkLogin['id'],
              'expire' => time() + 604800,
              'secure' => TRUE
            );
            $this->input->set_cookie($rememberCookie);
          }

          //set variables in session
          $this->session->set_userdata('isAdminLoggedIn',TRUE);
          $this->session->set_userdata('adminId',$checkLogin['id']);
          $this->session->set_userdata('adminLoggedInTime', date('Y-m-d H:i:s'));

          //redirect to dashboard
          redirect('admin/dashboard');
        }else{
          $data['error_msg'] = 'Wrong username, email or password. Please try again.';
        }
      }
    }
    $data['title'] = 'Login';
    $this->load->view('admin/auth-login', $data);
  }

	/*
  * Admin logout
  */
  public function logout(){
    //remove cookie data
    delete_cookie('rememberAdminId');
    //remove session data
    $this->session->unset_userdata('isAdminLoggedIn');
    $this->session->unset_userdata('adminId');
    $this->session->unset_userdata('adminLoggedInTime');
    $this->session->sess_destroy();
    //redirect to login page
    redirect('admin/login');
  }

	/*
  * Show all admin
  */
  public function all_admin(){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $data = array();

    //get admin account data
    $data['is_login'] = 1;
    $data['admin'] = $this->admin_model->getRows(array('id'=>$this->adminId));
    $data['login_time'] = $this->session->userdata('adminLoggedInTime');
    $data['title'] = 'All Admin';

    //load all admin view
    $this->load->view('admin/all-admin', $data);
  }

  /*
  * Ajax get all admins
  */
  public function get_admins(){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $admin = $this->admin_model->getRows(array('id'=>$this->adminId));

    $data = $row = array();

    // Fetch admin's records
    $adminData = $this->admin_model->table_datas($_POST, 'admin');

    $count = $_POST['start'];
    foreach($adminData as $value){
      $count++;
      $badge = '';
      $picture = '';
      $edit_profile = '';
      $delete_profile = '';
      if($value->acc_type == 'webmaster'){
        $badge = '<div class="badge badge-webmaster">&nbsp;&nbsp;Webmaster&nbsp;&nbsp;</div>';
      }else{
        $badge = '<div class="badge badge-primary">'.ucwords($value->acc_type).'</div>';
      }
      if(empty($value->picture)){
        $picture = base_url().'assets/img/avatar/avatar-1.png';
      }else{
        $picture = base_url().'uploads/profile_picture/thumb/'.$value->picture;
      }
      if($value->hash != 'b47893b7f388f5ddf881110c2508f3c6'){
        $edit_profile = '<a href="'.base_url().'admin/admin-edit-profile/'.$value->hash.'" class="edit-link text-warning">Edit </a>|';
      }else{
        if($value->id == $admin['id']){
          $edit_profile = '<a href="'.base_url().'admin/admin-edit-profile/'.$value->hash.'" class="edit-link text-warning">Edit </a>|';
        }
      }
      if($value->id != $admin['id'] && $value->hash != 'b47893b7f388f5ddf881110c2508f3c6'){
        $delete_profile = '<a href="" data-username="'.$value->username.'" data-hash="'.$value->hash.'" class="delete-link text-danger"> Delete </a>|';
      }
      $data[] = array(
        '<div class="custom-checkbox custom-control">
        <input type="checkbox" data-checkboxes="mygroup" data-val="'.$value->username.'" value="'.$value->hash.'" class="custom-control-input" id="checkbox-'.$count.'">
        <label for="checkbox-'.$count.'" class="custom-control-label mouse-pointer">&nbsp;</label>
        </div>',
        '<a href="'.base_url().'admin/admin-view-profile/'.$value->hash.'"><img class="mr-2 rounded-circle avatar-picture-40" src="'.$picture.'"></a>
        <div class="media-body">
        <h6 class="media-title" style="margin: 5px 0 0 0; font-size: 13px;"><a href="'.base_url().'admin/admin-view-profile/'.$value->hash.'"><b>'.$value->username.'</b></a></h6>
        <div class="table-links" style="margin-top: 0;">'.
        $edit_profile.
        $delete_profile.
        '<a href="'.base_url().'admin/admin-view-profile/'.$value->hash.'" class="view-link text-info"> View</a>
        </div>
        </div>',
        $value->first_name.' '.$value->last_name,
        $value->email,
        $badge
      );
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->admin_model->count_all_row('admin'),
      "recordsFiltered" => $this->admin_model->count_filtered($_POST, 'admin'),
      "data" => $data,
    );

    // Output to JSON format
    echo json_encode($output);
  }

	/*
  * Ajax delete selected row
  */
  public function delete_selected_row(){
    $json = array();

    $error_message = '';
    $success_message = '';
    $result = false;

    $user_table = $this->input->post('user_table');
    $selected_hash = $this->input->post('selected_hash');
    $loggedin_hash = $this->input->post('loggedin_hash');
    $data_array = explode(',', $selected_hash);
    if(in_array($loggedin_hash, $data_array) || in_array('b47893b7f388f5ddf881110c2508f3c6', $data_array)){
      if(in_array($loggedin_hash, $data_array)){
        $error_message = 'You cannot delete your own account!';
      }else{
        $error_message = 'You cannot delete Webmaster!';
      }
    }else{
      $delete = $this->admin_model->delete_selected_accounts($user_table, $data_array);
      if($delete == true){
        $result = true;
        $success_message = 'Selected row(s) sucessfully deleted!';
      }else{
        $error_message = 'Selected row(s) failed to be deleted! Please try again.';
      }
    }

    $json = array(
      'error_message' => $error_message,
      'success_message' => $success_message,
      'result' => $result
    );
    $this->output->set_content_type('application/json')->set_output(json_encode($json));
  }

	/*
  * Create new admin
  */
  public function create_new_admin(){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $data = array();

    //get admin account data
    $data['is_login'] = 1;
    $data['admin'] = $this->admin_model->getRows(array('id'=>$this->adminId));
    $data['login_time'] = $this->session->userdata('adminLoggedInTime');
    $data['title'] = 'Create New Admin';

    //load create new admin view
    $this->load->view('admin/create-new-admin', $data);
  }

  /*
  * Ajax create new admin
  */
  public function ajax_new_admin(){
    $json = array();

    $error_message = '';
    $success_message = '';
    $first_name_error = '';
    $last_name_error = '';
    $username_error = '';
    $phone_error = '';
    $email_error = '';
    $password_error = '';
    $result = false;

    $this->form_validation->set_rules('first_name', 'first name', 'required');
    $this->form_validation->set_rules('last_name', 'last name', 'required');
    $this->form_validation->set_rules('username', 'username', 'required|callback_username_check[]|callback_username_check_blank');
    $this->form_validation->set_rules('phone', 'phone number', 'required');
    $this->form_validation->set_rules('password', 'password', 'required',
    array('required' => 'Please click generate password button'));
    $this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_email_check[]',
    array('required' => 'Please fill in email'));

    //validate submitted form data
    if($this->form_validation->run() == true) {
      $first_name = $this->input->post('first_name');
      $last_name = $this->input->post('last_name');
      $username = $this->input->post('username');
      $phone = $this->input->post('phone');
      $email = $this->input->post('email');
      $password = sha1(sha1(sha1($this->input->post('password'))));
      $raw_password = $this->input->post('password');
      $full_name = $first_name.' '.$last_name;

      $insert = $this->admin_model->insert_new_admin($first_name, $last_name, $username, $phone, $email, $password);

      if($insert != false){
        $result = true;
        $success_message = 'New Admin sucessfully created!';
      }else{
        $error_message = 'New Admin failed to be created! Please try again.';
      }

    }else{
      $error_message = 'You need to correct something on the form before continuing';
      $first_name_error = form_error('first_name');
      $last_name_error = form_error('last_name');
      $username_error = form_error('username');
      $phone_error = form_error('phone');
      $email_error = form_error('email');
      $password_error = form_error('password');
    }

    $json = array(
      'error_message' => $error_message,
      'success_message' => $success_message,
      'first_name_error' => $first_name_error,
      'last_name_error' => $last_name_error,
      'username_error' => $username_error,
      'phone_error' => $phone_error,
      'email_error' => $email_error,
      'password_error' => $password_error,
      'result' => $result
    );
    $this->output->set_content_type('application/json')->set_output(json_encode($json));
  }

	/*
  * Admin view profile
  */
  public function admin_view_profile($hash){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $data = array();

    if(!empty($hash)){
      $data['profile'] = $this->admin_model->return_profile($hash, 'admin');
      if(empty($data['profile'])){
        redirect('page_404');
      }
    }else{
      redirect('page_404');
    }

    //get admin information
    $data['is_login'] = 1;
    $data['admin'] = $this->admin_model->getRows(array('id' => $this->adminId));
    $data['login_time'] = $this->session->userdata('adminLoggedInTime');
    $data['title'] = 'View Profile';

    //load view-profile view
    $this->load->view('admin/admin-view-profile', $data);
  }

  /*
  * Admin edit profile
  */
  public function admin_edit_profile($hash){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $data = array();

    if(!empty($hash)){
      $profile = $this->admin_model->return_profile($hash, 'admin');
      if(empty($profile)){
        redirect('page_404');
      }else{
        //get admin information
        $adminData = $this->admin_model->getRows(array('id' => $profile['id']));
        $prevPicture = $adminData['picture'];

        //if update request is submitted
        if($this->input->post('updateProfile')){
          //form field validation rules
          $this->form_validation->set_rules('first_name', 'first name', 'required',
          array('required' => 'Please fill in first name'));
          $this->form_validation->set_rules('last_name', 'last name', 'required',
          array('required' => 'Please fill in last name'));
          $this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_email_check['.$profile['id'].']',
          array('required' => 'Please fill in email'));
          $this->form_validation->set_rules('phone', 'phone number', 'required',
          array('required' => 'Please fill in phone number'));
          $this->form_validation->set_rules('username', 'username', 'required|callback_username_check['.$profile['id'].']',
          array('required' => 'Please fill in username'));
          $this->form_validation->set_rules('file', '', 'callback_file_check');

          //prepare admin data
          $adminData = array(
            'first_name' => strip_tags($this->input->post('first_name')),
            'last_name' => strip_tags($this->input->post('last_name')),
            'email' => strip_tags($this->input->post('email')),
            'phone' => strip_tags($this->input->post('phone')),
            'username' => strip_tags($this->input->post('username')),
            'acc_type' => strip_tags($this->input->post('acc_type'))
          );

          $reset_password = $this->input->post('reset_password');
          $password = $this->input->post('password');
          if($reset_password == '1'){
            $adminData['password'] = sha1(sha1(sha1($password)));
          }

          //validate submitted form data
          if($this->form_validation->run() == true){
            //profile picture upload
            $upload_result = true;
            if(isset($_FILES['picture']['name']) && $_FILES['picture']['name']!=""){
							// create directory if not exist
					    if(!is_dir('uploads')){
					      mkdir('uploads', 0777, TRUE);
					    }
					    if(!is_dir('uploads/profile_picture/')){
					      mkdir('uploads/profile_picture/', 0777, TRUE);
					    }
							if(!is_dir('uploads/profile_picture/thumb/')){
					      mkdir('uploads/profile_picture/thumb/', 0777, TRUE);
					    }

              $targetDir = 'uploads/profile_picture/';
              //upload configuration
              $config['upload_path']   = $targetDir;
              $config['allowed_types'] = 'gif|jpg|jpeg|png';
							$config['max_size'] = '';
							$config['max_width'] = '';
							$config['max_height'] = '';
              $this->load->library('upload', $config);
              if($this->upload->do_upload('picture')){
                //load upload helper
                $this->load->helper('upload');

                $uploadData = $this->upload->data();
                $uploadedFile = $uploadData['file_name'];
                $sourceImage = $targetDir.$uploadedFile;
                $thumbPath = $targetDir."thumb/";
                create_thumb($sourceImage, $uploadedFile, $thumbPath, 128, 128);
                $adminData['picture'] = $uploadedFile;

                //delete previous profile picture
                @unlink('uploads/profile_picture/'.$prevPicture);
                @unlink('uploads/profile_picture/thumb/'.$prevPicture);
              }else{
                $upload_result = false;
                $data['error_msg'] = $this->upload->display_errors();
              }
            }
            if($upload_result == true){
              //update admin account data
              $update = $this->admin_model->update($adminData, array('id' => $profile['id']));

              //store status message
              if($update){
                $data['success_msg'] = 'Profile information has been updated successfully.';
              }else{
                $data['error_msg'] = 'Some problems occured, please try again.';
              }
            }
          }else{
            $data['error_msg'] = 'You need to correct something on the form before continuing';
          }
        }
      }
    }else{
      redirect('page_404');
    }

    //get admin information
    $data['is_login'] = 1;
    $adminData['picture'] = !empty($adminData['picture'])?$adminData['picture']:$prevPicture;
    $adminData['hash'] = $profile['hash'];
    $data['profile'] = $adminData;
    $data['admin'] = $this->admin_model->getRows(array('id' => $this->adminId));
    $data['login_time'] = $this->session->userdata('adminLoggedInTime');
    $data['title'] = 'Edit Profile';

    //load admin-view-profile view
    $this->load->view('admin/admin-edit-profile', $data);
  }

	/*
  * Show all files
  */
  public function all_files(){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $data = array();

    //get admin account data
    $data['is_login'] = 1;
    $data['admin'] = $this->admin_model->getRows(array('id'=>$this->adminId));
    $data['login_time'] = $this->session->userdata('adminLoggedInTime');
    $data['title'] = 'All Files';

    //load all files view
    $this->load->view('admin/all-files', $data);
  }

  /*
  * Ajax get all files
  */
  public function get_files(){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $admin = $this->admin_model->getRows(array('id'=>$this->adminId));

    $data = $row = array();

    // Fetch file's records
    $fileData = $this->admin_model->table_datas($_POST, 'file');

    $count = $_POST['start'];
    foreach($fileData as $value){
      $count++;
      $data[] = array(
				'<div class="custom-checkbox custom-control">
        <input type="checkbox" data-checkboxes="mygroup" data-val="'.$value->file_name.'" value="'.$value->hash.'" class="custom-control-input" id="checkbox-'.$count.'">
        <label for="checkbox-'.$count.'" class="custom-control-label mouse-pointer">&nbsp;</label>
        </div>',
        '<i class="fas fa-file"></i> &nbsp;'.$value->file_name,
        $value->file,
        $value->admin_id,
        date("d M Y", strtotime($value->created)),
				'<a href="'.base_url().'admin/edit-file/'.$value->hash.'" class="btn btn-icon btn-primary mr-2" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a>
				<a href="'.base_url().'share/file/'.$value->hash.'" class="btn btn-icon btn-success" data-toggle="tooltip" title="Link" target="_blank"><i class="fas fa-link"></i></a>'
      );
    }

    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->admin_model->count_all_row('file'),
      "recordsFiltered" => $this->admin_model->count_filtered($_POST, 'file'),
      "data" => $data,
    );

    // Output to JSON format
    echo json_encode($output);
  }

	/*
  * Add new file
  */
  public function add_new_file(){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $data = array();

    //get admin account data
    $data['is_login'] = 1;
    $data['admin'] = $this->admin_model->getRows(array('id'=>$this->adminId));
    $data['login_time'] = $this->session->userdata('adminLoggedInTime');
    $data['title'] = 'Add New File';

    //load add new file view
    $this->load->view('admin/add-new-file', $data);
  }

  /*
  * Ajax add new file
  */
  public function ajax_new_file(){
    $json = array();

    $error_message = '';
    $success_message = '';
    $file_name_error = '';
    $password_error = '';
    $result = false;

    $this->form_validation->set_rules('file_name', 'file name', 'required');
    $this->form_validation->set_rules('password', 'password', 'required',
    array('required' => 'Please click generate password button'));

    //validate submitted form data
    if($this->form_validation->run() == true) {
      $file_name = $this->input->post('file_name');
			$file = $this->input->post('file');
			$admin_id = $this->adminId;
      $password = sha1(sha1(sha1($this->input->post('password'))));

			// new file upload
      $upload_result = true;
			if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
				// create directory if not exist
				if(!is_dir('shared_file')){
					mkdir('shared_file', 0777, TRUE);
				}
				$targetDir = 'shared_file/';

				//upload configuration
				$config['upload_path']   = $targetDir;
				$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|csv|psd|m4a|xls|mp3|word|txt|text|doc|docx|xlsx';
				$config['max_size'] = '';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('file')){
					//load upload helper
					$this->load->helper('upload');

					$uploadData = $this->upload->data();
					$uploadedFile = $uploadData['file_name'];
					$sourceImage = $targetDir.$uploadedFile;
					$file = $uploadedFile;
				}else{
					$upload_result = false;
					$data['error_msg'] = $this->upload->display_errors();
				}
			}
			$insert = false;
			if($upload_result == true){
				// insert file into db
				$insert = $this->admin_model->insert_new_file($file_name, $file, $admin_id, $password);
			}

      if($insert != false){
        $result = true;
        $success_message = 'New file sucessfully added!';
      }else{
        $error_message = 'New file failed to be added! Please try again.';
      }

    }else{
      $error_message = 'You need to correct something on the form before continuing';
      $file_name_error = form_error('first_name');
      $password_error = form_error('password');
    }

    $json = array(
      'error_message' => $error_message,
      'success_message' => $success_message,
      'file_name_error' => $file_name_error,
      'password_error' => $password_error,
      'result' => $result
    );
    $this->output->set_content_type('application/json')->set_output(json_encode($json));
  }

	/*
  * Edit file
  */
  public function edit_file($hash){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $data = array();

    if(!empty($hash)){
      $file = $this->admin_model->return_file($hash, 'file');
      if(empty($file)){
        redirect('page_404');
      }else{
        // get file information
        $fileData = $file;

        // if update request is submitted
        if($this->input->post('updateFile')){
          //form field validation rules
          $this->form_validation->set_rules('file_name', 'file name', 'required',
          array('required' => 'Please fill in file name'));

          // prepare file data
          $fileData = array(
            'file_name' => strip_tags($this->input->post('file_name')),
						'updated' => date("Y-m-d H:i:s")
          );

          $reset_password = $this->input->post('reset_password');
          $password = $this->input->post('password');
					if($reset_password == '1'){
						$fileData['password'] = sha1(sha1(sha1($password)));
					}

					// validate submitted form data
					if($this->form_validation->run() == true){
						// update file data
						$update = $this->admin_model->update_file($file['id'], $fileData);

						//store status message
						if($update){
							$data['success_msg'] = 'File information has been updated successfully.';
						}else{
							$data['error_msg'] = 'Some problems occured, please try again.';
						}
					}else{
						$data['error_msg'] = 'You need to correct something on the form before continuing';
					}
				}
			}
		}else{
			redirect('page_404');
		}

    // get file information
    $data['is_login'] = 1;
    $fileData['hash'] = $file['hash'];
    $data['file'] = $fileData;
    $data['admin'] = $this->admin_model->getRows(array('id' => $this->adminId));
    $data['login_time'] = $this->session->userdata('adminLoggedInTime');
    $data['title'] = 'Edit File';

    //load edit file view
    $this->load->view('admin/edit-file', $data);
  }

	/*
  * Admin edit profile
  */
  public function edit_profile(){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $data = array();

    //get admin information
    $adminData = $this->admin_model->getRows(array('id'=>$this->adminId));
    $prevPicture = $adminData['picture'];

    //if update request is submitted
    if($this->input->post('updateProfile')){
      //form field validation rules
      $this->form_validation->set_rules('first_name', 'first name', 'required',
      array('required' => 'Please fill in first name'));
      $this->form_validation->set_rules('last_name', 'last name', 'required',
      array('required' => 'Please fill in last name'));
      $this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_email_check[' . $this->adminId . ']',
      array('required' => 'Please fill in email'));
      $this->form_validation->set_rules('phone', 'phone number', 'required',
      array('required' => 'Please fill in phone number'));
      $this->form_validation->set_rules('username', 'username', 'required|callback_username_check[' . $this->adminId . ']',
      array('required' => 'Please fill in username'));
      $this->form_validation->set_rules('file', '', 'callback_file_check');

      //prepare admin data
      $adminData = array(
        'first_name' => strip_tags($this->input->post('first_name')),
        'last_name' => strip_tags($this->input->post('last_name')),
        'email' => strip_tags($this->input->post('email')),
        'phone' => strip_tags($this->input->post('phone')),
        'username' => strip_tags($this->input->post('username')),
        'acc_type' => strip_tags($this->input->post('acc_type'))
      );

      //validate submitted form data
      if($this->form_validation->run() == true){
        //profile picture upload
        $upload_result = true;
        if(isset($_FILES['picture']['name']) && $_FILES['picture']['name']!=""){
					// create directory if not exist
					if(!is_dir('uploads')){
						mkdir('uploads', 0777, TRUE);
					}
					if(!is_dir('uploads/profile_picture/')){
						mkdir('uploads/profile_picture/', 0777, TRUE);
					}
					if(!is_dir('uploads/profile_picture/thumb/')){
						mkdir('uploads/profile_picture/thumb/', 0777, TRUE);
					}

          $targetDir = 'uploads/profile_picture/';
          //upload configuration
          $config['upload_path']   = $targetDir;
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
					$config['max_size'] = '';
					$config['max_width'] = '';
					$config['max_height'] = '';
          $this->load->library('upload', $config);
          if($this->upload->do_upload('picture')){
            //load upload helper
            $this->load->helper('upload');

            $uploadData = $this->upload->data();
            $uploadedFile = $uploadData['file_name'];
            $sourceImage = $targetDir.$uploadedFile;
            $thumbPath = $targetDir."thumb/";
            create_thumb($sourceImage, $uploadedFile, $thumbPath, 128, 128);
            $adminData['picture'] = $uploadedFile;

            //delete previous profile picture
            @unlink('uploads/profile_picture/'.$prevPicture);
            @unlink('uploads/profile_picture/thumb/'.$prevPicture);
          }else{
            $upload_result = false;
            $data['error_msg'] = $this->upload->display_errors();
          }
        }
        if($upload_result == true){
          //update admin account data
          $update = $this->admin_model->update($adminData, array('id'=>$this->adminId));

          //store status message
          if($update){
            $data['success_msg'] = 'Your profile information has been updated successfully.';
          }else{
            $data['error_msg'] = 'Some problems occured, please try again.';
          }
        }
      }else{
        $data['error_msg'] = 'You need to correct something on the form before continuing';
      }
    }

    //get admin account data
    $data['is_login'] = 1;
    $adminData['picture'] = !empty($adminData['picture'])?$adminData['picture']:$prevPicture;
    $data['admin'] = $adminData;
    $data['login_time'] = $this->session->userdata('adminLoggedInTime');
    $data['title'] = 'Edit Profile';

    //load edit profile view
    $this->load->view('admin/edit-profile', $data);
  }

  /*
  * Admin account password change
  */
  public function change_password(){
    //check admin login status
    $this->admin_init_elements->is_admin_loggedin();
    $data = array();

    //get admin information
    $adminData = $this->admin_model->getRows(array('id'=>$this->adminId));

    //if update request is submitted
    if($this->input->post('updatePassword')){
      //form field validation rules
      $this->form_validation->set_rules('current_password', 'current password', 'required|callback_oldpass_check[' . $this->adminId . ']', array('oldpass_check' => 'Current password entered is wrong.'));
      $this->form_validation->set_rules('new_password', 'new password', 'required|min_length[8]', array('min_length' => 'Your password must be at least 8 characters long.'));
      $this->form_validation->set_rules('confirm_password', 'confirm password', 'required|matches[new_password]', array('matches' => 'New password does not match confirm password.'));

      //validate submitted form data
      if($this->form_validation->run() == true){
        //prepare admin data
        $newPassword = sha1(sha1(sha1($this->input->post('new_password'))));
        $adminDataP = array('password' => $newPassword);

        //update admin account password
        $update = $this->admin_model->update($adminDataP, array('id' => $this->adminId));

        //store status message
        if($update){
          $data['success_msg'] = 'Your account password has been updated successfully.';
        }else{
          $data['error_msg'] = 'Some problems occured, please try again.';
        }
      }else{
        $data['error_msg'] = 'You need to correct something on the form before continuing';
      }
    }

    //get admin account data
    $data['is_login'] = 1;
    $data['admin'] = $adminData;
    $data['login_time'] = $this->session->userdata('adminLoggedInTime');
    $data['title'] = 'Change Password';

    //load change password view
    $this->load->view('admin/change-password', $data);
  }

	/*
  * Existing username check during validation
  */
  public function username_check($str, $id = ''){
    $con['returnType'] = 'count';
    if ($id != '') {
      $con['conditions'] = array('username'=>$str, 'id != ' => $id);
    } else {
      $con['conditions'] = array('username'=>$str);
    }
    $checkUsername = $this->admin_model->getRows($con);
    if($checkUsername > 0){
      $this->form_validation->set_message('username_check', 'Username already exists. Use another.');
      return FALSE;
    } else {
      return TRUE;
    }
  }

	/*
  * Existing email check during validation
  */
  public function email_check($str, $id = ''){
    $con['returnType'] = 'count';
    if ($id != '') {
      $con['conditions'] = array('email'=>$str, 'id != ' => $id);
    } else {
      $con['conditions'] = array('email'=>$str);
    }
    $checkEmail = $this->admin_model->getRows($con);
    if($checkEmail > 0){
      $this->form_validation->set_message('email_check', 'Email already exists. Use another.');
      return FALSE;
    } else {
      return TRUE;
    }
  }

	/*
  * Old password check during validation
  */
  public function oldpass_check($str, $id){
    $password = sha1(sha1(sha1($str)));
    $con['returnType'] = 'count';
    $con['conditions'] = array('id'=>$id, 'password'=>$password);
    $checkPass = $this->admin_model->getRows($con);
    if($checkPass > 0){
      return TRUE;
    } else {
      $this->form_validation->set_message('oldpass_check', 'Password entered does not match with your account password.');
      return FALSE;
    }
  }

  /*
  * file value and type check during validation
  */
  public function file_check($str){
    $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
    if(isset($_FILES['picture']['name']) && $_FILES['picture']['name']!=""){
      $mime = get_mime_by_extension($_FILES['picture']['name']);
      if(in_array($mime, $allowed_mime_type_arr)){
        return true;
      }else{
        $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
        return false;
      }
    }else{
      return true;
    }
  }

	/*
  * Username blank space validation
  */
  public function username_check_blank($str){
    $pattern = '/ /';
    $result = preg_match($pattern, $str);

    if ($result){
      $this->form_validation->set_message('username_check_blank', 'The %s field can not have a blank space');
      return FALSE;
    }
    else{
      return TRUE;
    }
  }
}
