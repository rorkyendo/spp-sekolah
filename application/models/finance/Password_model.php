<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password_model extends CI_Model
{
	function __construct()
  {
      parent::__construct();
  }

  function get_general($table)
  {
    $query = $this->db->get($table);
		return $query->result();
  }

  function get_by_id_general($table, $id, $val)
  {
    $query = $this->db->where($id, $val)->get($table);
		return $query->result();
  }

	function create_general($table, $data)
	{
		return $this->db->insert($table, $data);
	}

	function update_general($table, $id, $val, $data)
	{
		$this->db->where($id, $val);
		return $this->db->update($table, $data);
	}

	function delete_general($table, $id, $val)
	{
		$this->db->where($id, $val);
		return $this->db->delete($table);
	}

	function count_media($table)
	{
		$this->db->from($table);
		return $this->db->count_all_results();
	}

	function count_registration($role)
	{
    $this->db->where('users_role_id', $role);
		$this->db->from('ws_users');
		return $this->db->count_all_results();
	}

	function get_profile($id)
	{
		return $this->db->query("SELECT * FROM ws_users,ws_admin WHERE ws_users.users_user_id = ws_admin.id AND ws_users.users_id = $id")->result();
	}

	function get_password($password, $table)
	{
		$this->db->like('password', $password);
    	$query = $this->db->get($table);

		return $query->row();
	}
}
?>
