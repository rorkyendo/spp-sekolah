<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
			parent::__construct();
			$this->load->library('pagination');
    	$this->session->set_userdata('page','media');
			$this->load->model('media_model', 'dbObject');
    }

	public function index()
	{
		redirect(base_url());
	}

	public function post($param='')
	{
		if($param == null){
			redirect('media','refresh');
		}
		$table = 'ws_media';
		$id_name = 'media_id';
		$data['detail_media'] = $this->dbObject->get_media_by_id($param);
		$data['comment'] = $this->dbObject->get_comment($param);
		$data['media_limit_3'] = $this->dbObject->get_media_limit_3();
		$data['media'] = $this->dbObject->get_media_limit();
		$data['content'] = 'media';
		$this->load->view('templates/header');
		$this->load->view('templates/navbar');
		$this->load->view('media_detail', $data);
		$this->load->view('templates/footer',$data);
	}

	public function comment($param1='')
	{
		$name = $this->input->post('name');
		$comment = $this->input->post('comment');

		$data = array(
			'media_id' => $param1,
			'comment' => $comment,
			'name' => $name
		);

		$this->dbObject->create_general('ws_media_comment',$data);
		$this->session->set_flashdata('notif','<div class="alert alert-info">Komentar berhasil ditambahkan</div>');
		redirect('media/post/'.$param1);
	}

	public function search()
	{
		$data['media'] = $this->dbObject->get_media_limit();
		$data['media_category'] = $this->dbObject->get_media_category();
		$data['media_limit_3'] = $this->dbObject->get_media_limit_3();
		$keyword = $this->input->get('keyword');
		$config = array();
		$config["base_url"] = base_url() . "index.php/media/search?=".$keyword;
		$total_row = $this->dbObject->get_rows_media_by_keyword($keyword);
		$config["total_rows"] = $total_row;
		$config['use_page_numbers'] = TRUE;
		$config["per_page"] = 1;
		$config["uri_segment"] = 5;
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		$data["media_content"] = $this->dbObject->data_media_by_keyword($config["per_page"], $data['page'],$keyword);
		$data["links"] = $this->pagination->create_links();
		$this->session->set_userdata('search',TRUE);
		$data['content'] = 'searchpage';
		$this->load->view('templates/header');
		$this->load->view('templates/navbar');
		$this->load->view('templates/masterslider',$data);
		$this->load->view('welcome', $data);
		$this->load->view('templates/footer',$data);
	}

}
