<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome_model extends CI_Model
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

    function create_general($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    function get_media_limit()
    {
    	$query = $this->db->query('SELECT * FROM ws_media, ws_media_kategori WHERE ws_media.media_med_kat_id = ws_media_kategori.med_kat_id ORDER BY ws_media.media_created_time desc LIMIT 6');
			return $query->result();
    }

		function get_media_limit_3()
		{
			$query = $this->db->query('SELECT * FROM ws_media, ws_media_kategori WHERE ws_media.media_med_kat_id = ws_media_kategori.med_kat_id ORDER BY ws_media.media_created_time desc LIMIT 5');
			return $query->result();
		}

		function get_media_limit_by_category()
		{
			$query = $this->db->query('SELECT * FROM ws_media, ws_media_kategori, ws_admin WHERE
				ws_media.media_med_kat_id = ws_media_kategori.med_kat_id and ws_admin.id=ws_media.media_created_by
				ORDER BY ws_media.media_created_time desc LIMIT 6');
			return $query->result();
		}

		function get_media_by_category_id_limit_one($cat_id)
		{
			$query = $this->db->query("SELECT * FROM ws_media, ws_media_kategori, ws_admin WHERE
			ws_media.media_med_kat_id=$cat_id AND ws_admin.id=ws_media.media_created_by
			ORDER BY ws_media.media_created_time desc LIMIT 1");
			return $query->result();
		}

		function get_media_by_category_id_limit_six($cat_id)
		{
			$this->db->limit(6);
			$query = $this->db->query("SELECT * FROM ws_media, ws_media_kategori, ws_admin WHERE
			ws_media.media_med_kat_id=$cat_id AND ws_admin.id=ws_media.media_created_by and ws_media.media_med_kat_id = ws_media_kategori.med_kat_id
			ORDER BY ws_media.media_created_time desc");
			return $query->result();
		}

		function get_media_category()
		{
			return $this->db->query('SELECT * FROM ws_media_kategori mk')->result();
		}

		//
}
?>
