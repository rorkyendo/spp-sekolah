<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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

    		if ($this->session->userdata('login') == 0 || $this->session->userdata('user_level') != '1') redirect('auth/logout');
			$this->session->set_userdata('menu','dashboard');
			$this->load->model('admin/dashboard_model', 'dbObject');
    }

	public function index()
	{
		$data['title']='Admin Dashboard';
		$data['pegawai'] = $this->dbObject->count_registration(2);
		$data['media'] = $this->dbObject->count_media("ws_media");
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar',$data);
		$this->load->view('admin/dashboard/index',$data);
		$this->load->view('admin/templates/footer');
	}
}
