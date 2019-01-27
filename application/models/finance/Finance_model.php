<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Finance_model extends CI_Model
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

	function get_siswa()
	{
		$query = $this->db->query("SELECT * FROM ws_siswa,ws_users,ws_major WHERE ws_siswa.id = ws_users.users_user_id AND ws_users.users_role_id = '3'
			and ws_siswa.major_id=ws_major.major_id");
		return $query->result();
	}

	function get_siswa_search($major,$class,$keyword)
	{
		$query = $this->db->query("SELECT * FROM ws_siswa,ws_users,ws_major WHERE
			ws_siswa.id = ws_users.users_user_id AND ws_users.users_role_id = '3'
			and ws_siswa.major_id=ws_major.major_id
			and ws_siswa.class='$class' and ws_siswa.major_id='$major' group by ws_siswa.nisn");
		return $query->result();
	}


	function get_siswa_by_id($id)
	{
		$query = $this->db->query("SELECT * FROM ws_siswa,ws_users WHERE ws_siswa.id = ws_users.users_user_id AND ws_users.users_role_id = '3' AND ws_siswa.id = '$id'");
		return $query->result();
	}

	function get_username_siswa($users_username)
	{
	   	$this->db->like('users_username',$users_username);
	    $query = $this->db->get('ws_users');
	    return $query->result();
	}

	function get_nisn($nisn)
	{
			$this->db->where('nisn',$nisn);
			$query = $this->db->get('ws_siswa');
			return $query->result();
	}

	function get_school_fees($start_date,$end_date)
	{
		$sql = "SELECT * FROM ws_siswa s, ws_school_fees sf, ws_major m, ws_finance f where s.id = sf.id_siswa and sf.id_sf = REPLACE(f.approval_code,'SF','') and s.major_id = m.major_id
		and payment_date between '$start_date' and '$end_date'";
		return $this->db->query($sql)->result();
	}

	function get_school_fees_by_detail($start_date,$end_date,$major_id,$class)
	{
		$sql = "SELECT * FROM ws_siswa s, ws_school_fees sf, ws_major m, ws_finance f where s.id = sf.id_siswa and sf.id_sf = REPLACE(f.approval_code,'SF','') and s.major_id = '$major_id' and s.class = '$class'
		and payment_date between '$start_date' and '$end_date' group by s.nisn";
		return $this->db->query($sql)->result();
	}

	function get_debit_by_date($start_date,$end_date)
	{
		$sql = "SELECT * FROM ws_finance f where f.created_time between '$start_date' and '$end_date' and f.status=1";
		return $this->db->query($sql)->result();
	}

	function get_kredit_by_date($start_date,$end_date)
	{
		$sql = "SELECT * FROM ws_finance f where f.created_time between '$start_date' and '$end_date' and f.status=0";
		return $this->db->query($sql)->result();
	}

	function get_report_by_date($start_date,$end_date)
	{
		$sql = "SELECT * FROM ws_finance f where f.created_time between '$start_date' and '$end_date'";
		return $this->db->query($sql)->result();
	}

}
?>
