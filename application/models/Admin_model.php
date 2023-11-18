<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{
  function __construct()
  {
    $this->userTbl = 'admin';

    // Set admin orderable column fields
    $this->admin_column_order = array(null, 'username', 'first_name', 'email', 'acc_type');
    // Set admin searchable column fields
    $this->admin_column_search = array('username', 'first_name', 'email', 'acc_type');
    // Set default admin order
    $this->admin_order = array('created' => 'asc');

    // Set files orderable column fields
    $this->files_column_order = array(null, 'file_name', 'file', 'admin_id', 'created');
    // Set files searchable column fields
    $this->files_column_search = array('file_name', 'file', 'admin_id', 'created');
    // Set default files order
    $this->files_order = array('created' => 'asc');
  }
  /*
  * Get rows from the admin table
  */
  function getRows($params = array())
  {
    $this->db->select('u.*');
    $this->db->from($this->userTbl . ' as u');

    //fetch data by conditions
    if (array_key_exists("conditions", $params)) {
      foreach ($params['conditions'] as $key => $value) {
        if (strpos($key, '.') !== false) {
          $this->db->where($key, $value);
        } else {
          $this->db->where('u.' . $key, $value);
        }
      }
    }

    if (array_key_exists("id", $params)) {
      $this->db->where('u.id', $params['id']);
      $query = $this->db->get();
      $result = $query->row_array();
    } else {
      //set start and limit
      if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
        $this->db->limit($params['limit'], $params['start']);
      } elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
        $this->db->limit($params['limit']);
      }
      $query = $this->db->get();
      if (array_key_exists("returnType", $params) && $params['returnType'] == 'count') {
        $result = $query->num_rows();
      } elseif (array_key_exists("returnType", $params) && $params['returnType'] == 'single') {
        $result = ($query->num_rows() > 0) ? $query->row_array() : FALSE;
      } else {
        $result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
      }
    }

    //return fetched data
    return $result;
  }

  /*
  * Insert admin information
  */
  public function insert($data = array())
  {
    //add created and modified date if not included
    if (!array_key_exists("created", $data)) {
      $data['created'] = date("Y-m-d H:i:s");
    }
    if (!array_key_exists("modified", $data)) {
      $data['modified'] = date("Y-m-d H:i:s");
    }

    //insert admin data to admin table
    $insert = $this->db->insert($this->userTbl, $data);

    //return the status
    if ($insert) {
      return $this->db->insert_id();
    } else {
      return false;
    }
  }

  /*
  * Update admin information
  */
  public function update($data, $conditions)
  {
    if (!empty($data) && is_array($data) && !empty($conditions)) {
      //add modified date if not included
      if (!array_key_exists("modified", $data)) {
        $data['modified'] = date("Y-m-d H:i:s");
      }

      //update admin data to admin table
      $update = $this->db->update($this->userTbl, $data, $conditions);
      return $update ? true : false;
    } else {
      return false;
    }
  }

  /*
  * Fetch table data from the database
  * @param $_POST filter data based on the posted parameters
  */
  public function table_datas($postData, $table)
  {
    $this->_get_datatables_query($postData, $table);
    if ($postData['length'] != -1) {
      $this->db->limit($postData['length'], $postData['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  /*
  * Count all table records
  */
  public function count_all_row($table)
  {
    $this->db->from($table);
    return $this->db->count_all_results();
  }

  /*
  * Count table records based on the filter params
  * @param $_POST filter data based on the posted parameters
  */
  public function count_filtered($postData, $table)
  {
    $this->_get_datatables_query($postData, $table);
    $query = $this->db->get();
    return $query->num_rows();
  }

  /*
  * Perform the SQL queries needed for an server-side processing requested
  * @param $_POST filter data based on the posted parameters
  */
  private function _get_datatables_query($postData, $table)
  {
    $this->db->from($table);

    $column_search = array();
    $column_order = array();
    $ordering = array();
    if ($table == 'admin') {
      $column_search = $this->admin_column_search;
      $column_order = $this->admin_column_order;
      $ordering = $this->admin_order;
    } else if ($table == 'file') {
      $column_search = $this->files_column_search;
      $column_order = $this->files_column_order;
      $ordering = $this->files_order;
    }

    $i = 0;
    // loop searchable columns
    foreach ($column_search as $item) {
      // if datatable send POST for search
      if ($postData['search']['value']) {
        // first loop
        if ($i === 0) {
          // open bracket
          $this->db->group_start();
          $this->db->like($item, $postData['search']['value']);
        } else {
          $this->db->or_like($item, $postData['search']['value']);
        }

        // last loop
        if (count($column_search) - 1 == $i) {
          // close bracket
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($postData['order'])) {
      $this->db->order_by($column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
    } else if (isset($ordering)) {
      $order = $ordering;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  /*
  * Delete selected admin
  */
  public function delete_selected_accounts($user_table, $data_array)
  {
    $this->db->where_in('hash', $data_array);
    if ($this->db->delete($user_table)) {
      return true;
    } else {
      return false;
    }
  }

  /*
  * Return admin profile info
  */
  public function return_profile($hash, $table)
  {
    $query = $this->db->from($table)->where('hash', $hash)->get();
    $row = $query->row_array();
    return $row;
  }

  /*
  * Return file info
  */
  public function return_file($hash, $table)
  {
    $query = $this->db->from($table)->where('hash', $hash)->get();
    $row = $query->row_array();
    return $row;
  }

  /*
  * Insert new admin
  */
  public function insert_new_admin($first_name, $last_name, $username, $phone, $email, $password)
  {
    $created = date("Y-m-d H:i:s");
    $modified = date("Y-m-d H:i:s");
    $data = array(
      'first_name' => $first_name,
      'last_name' => $last_name,
      'username' => $username,
      'email' => $email,
      'password' => $password,
      'phone' => $phone,
      'acc_type' => 'administrator',
      'created' => $created,
      'modified' => $modified
    );

    if ($this->db->insert('admin', $data)) {
      $insertId = $this->db->insert_id();
      $data_hash = array(
        'hash' => md5($insertId . $created)
      );
      $this->db->where('id', $insertId)->update('admin', $data_hash);
      return $insertId;
    } else {
      return false;
    }
  }

  /*
  * Insert new file
  */
  public function insert_new_file($file_name, $file, $admin_id, $password)
  {
    $created = date("Y-m-d H:i:s");
    $updated = date("Y-m-d H:i:s");
    $data = array(
      'admin_id' => $admin_id,
      'file_name' => $file_name,
      'file' => $file,
      'password' => $password,
      'created' => $created,
      'updated' => $updated,
      'downloaded' => 0
    );

    if ($this->db->insert('file', $data)) {
      $insertId = $this->db->insert_id();
      $data_hash = array(
        'hash' => md5($insertId . $created)
      );
      $this->db->where('id', $insertId)->update('file', $data_hash);
      return $insertId;
    } else {
      return false;
    }
  }

  /*
  * Update file
  */
  public function update_file($id, $fileData)
  {
    $update = $this->db->where('id', $id)->update('file', $fileData);
    return $update ? true : false;
  }

  /*
  * Get total downloads
  */
  public function get_total_downloads()
  {
    $this->db->select_sum('downloaded');
    $query = $this->db->get('file');
    return $query->row()->downloaded;
  }

  /*
  * Get most download file
  */
  public function most_download()
  {
    $this->db->select('*');
    $this->db->select_max('downloaded');
    $this->db->from('file');
    $this->db->group_by('id');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row();
    } else {
      return false;
    }
  }

  /*
  * Get most download admin
  */
  public function most_download_admin()
  {
    $sql = "SELECT admin_id,
    MAX(total_download) AS highest
    FROM
    (SELECT admin_id, SUM(downloaded) AS total_download FROM file GROUP BY admin_id) a
    GROUP BY admin_id";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $admin_id = $query->row()->admin_id;

      $query_admin = $this->db->from('admin')->where('id', $admin_id)->get();
      $row = $query_admin->row();
      return $row->first_name . ' ' . $row->last_name;
    }

    return false;
  }

  /*
  * Get top 5 most download file
  */
  public function top_5()
  {
    $query = $this->db->from('file')->order_by('downloaded', 'DESC')->limit(5)->get();
    $query->result_array();
    return $query->result();
  }
}
