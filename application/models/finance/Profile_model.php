<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model
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

	function count_registration($role)
	{
    $this->db->where('users_role_id', $role);
		$this->db->from('ws_siswa');
		return $this->db->count_all_results();
	}

	function get_profile($id)
	{
		return $this->db->query("SELECT * FROM ws_users u ,ws_pegawai p WHERE u.users_user_id = p.id AND u.users_id = $id")->result();
	}

	function get_username_pegawai($users_username)
	{
			$this->db->where('users_username',$users_username);
			$query = $this->db->get('ws_users');
			return $query->result();
	}

}
?>
