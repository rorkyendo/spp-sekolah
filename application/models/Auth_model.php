<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }

    function create_general($table, $data)
    {
        return $this->db->insert($table, $data);
	}

	function get_user($username)
	{
		$this->db->where('users_username', $username);
    $query = $this->db->get('ws_users');
		return $query->result();
	}

	function get_media_limit_3()
	{
		$query = $this->db->query('SELECT * FROM ws_media, ws_media_kategori WHERE ws_media.media_med_kat_id = ws_media_kategori.med_kat_id ORDER BY ws_media.media_created_time desc LIMIT 5');
		return $query->result();
	}

	function get_password($password, $table)
	{
		$this->db->like('password', $password);
    	$query = $this->db->get($table);

		return $query->row();
	}

	function get_name($table)
	{
		$query = $this->db->get($table);

		return $query->row();
	}

	function get_username($new)
	{
		return $query = $this->db->query("SELECT users_username FROM ws_users WHERE users_username = '$new'")->result();
	}

}
?>
