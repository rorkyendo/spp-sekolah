<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registration_model extends CI_Model
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

  function get_conditional_general($table, $id, $val)
  {
    $this->db->where($id, $val);
    $query = $this->db->get($table);
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

	function get_pegawai()
	{
		$query = $this->db->query("SELECT * FROM ws_pegawai,ws_users WHERE ws_pegawai.id = ws_users.users_user_id AND ws_users.users_role_id = '2'");
		return $query->result();
	}

	function get_pegawai_by_id($id)
	{
		$query = $this->db->query("SELECT * FROM ws_pegawai,ws_users WHERE ws_pegawai.id = ws_users.users_user_id AND ws_users.users_role_id = '2' AND ws_pegawai.id = '$id'");
		return $query->result();
	}

	function get_username_pegawai($users_username)
	{
	   	$this->db->where('users_username',$users_username);
	    $query = $this->db->get('ws_users');
	    return $query->result();
	}

	function get_nip($nip)
	{
			$this->db->where('nip',$nip);
			$query = $this->db->get('ws_pegawai');
			return $query->result();
	}

}
?>
