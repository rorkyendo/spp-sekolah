<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_model extends CI_Model
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

		function get_media_category()
		{
			return $this->db->query('SELECT * FROM ws_media_kategori mk')->result();
		}

    function get_media()
    {
    	$query = $this->db->query('SELECT * FROM ws_media, ws_media_kategori WHERE ws_media.media_med_kat_id = ws_media_kategori.med_kat_id ORDER BY ws_media.media_created_time desc');
		return $query->result();
    }

	   function get_media_by_id($id)
    {
    	$this->db->order_by('media_create_date', 'desc');
    	$query = $this->db->query("SELECT * FROM ws_media, ws_media_kategori,ws_admin WHERE ws_media.media_id = '$id' AND ws_media.media_med_kat_id = ws_media_kategori.med_kat_id and ws_media.media_created_by=ws_admin.id");
		  return $query->result();
    }

    function get_media_limit_3()
		{
			$query = $this->db->query('SELECT * FROM ws_media, ws_media_kategori WHERE ws_media.media_med_kat_id = ws_media_kategori.med_kat_id ORDER BY ws_media.media_created_time desc LIMIT 5');
			return $query->result();
		}

    function get_media_limit()
    {
      $query = $this->db->query('SELECT * FROM ws_media, ws_media_kategori WHERE ws_media.media_med_kat_id = ws_media_kategori.med_kat_id ORDER BY ws_media.media_created_time desc LIMIT 6');
      return $query->result();
    }

		function create_general($tbl,$data)
		{
			$this->db->insert($tbl,$data);
		}

		function get_comment($val)
		{
			return $this->db->query("SELECT * FROM ws_media_comment a WHERE a.media_id = '$val'")->result();
		}

		function data_media_by_keyword($number,$offset,$keyword)
		{

			$sql="SELECT * FROM ws_media, ws_media_kategori, ws_users WHERE ws_media.media_med_kat_id = ws_media_kategori.med_kat_id
			and ws_media_kategori.med_kat_name like '%$keyword%' or ws_media.media_judul like '%$keyword%' and ws_media.media_created_by = ws_users.users_id
			 LIMIT $number OFFSET $offset";

			return $query = $this->db->query($sql)->result();
		}

		function get_rows_media_by_keyword($keyword)
		{
			$sql="SELECT * FROM ws_media, ws_media_kategori WHERE ws_media.media_med_kat_id = ws_media_kategori.med_kat_id
			and ws_media_kategori.med_kat_name like '%$keyword%' or ws_media.media_judul like '%$keyword%'";

			return $this->db->query($sql)->num_rows();
		}
}
?>
