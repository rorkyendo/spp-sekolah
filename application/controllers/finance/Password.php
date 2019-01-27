<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

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
		if($this->session->userdata('login') == 0 || $this->session->userdata('user_level') != '2' && $this->session->userdata('group_id') != '2') redirect('auth/logout');
		$this->session->set_userdata('menu','profile');
		$this->load->model('finance/password_model', 'dbObject');
		$this->id = $this->session->userdata('user_id');
  }

  public $tbl = 'ws_pegawai';
	public $id_name = 'id';
	public $tbl2 = 'ws_users';
	public $id_name2 = 'users_id';

	public function index()
	{
		$data['title']='Finance Password';
		$data['password'] = $this->dbObject->get_profile($this->id);
		$this->load->view('finance/templates/header');
		$this->load->view('finance/templates/sidebar',$data);
		$this->load->view('finance/password/index',$data);
		$this->load->view('finance/templates/footer');
	}


	public function update($param1='',$param2='')
	{
		$passwordlama=md5($this->input->post('passwordlama'));
		$passwordbaru=md5($this->input->post('passwordbaru'));
		$passowrdconfirm=$this->dbObject->get_password($passwordlama,'ws_pegawai');

		if ($passowrdconfirm == TRUE) {
	    $data = array(
			'password' => $passwordbaru,
		);
		if($this->dbObject->update_general($this->tbl, $this->id_name, $param1, $data)===TRUE)		// using direct parameter
		{
				?>
				<script>
					alert(" Data berhasil diubah. ");
					location.replace("<?php echo base_url()?>index.php/finance/password/");
				</script>
				<?php
		}
		}
		else {
				?>
				<script>
					alert(" Data gagal diubah. ");
					location.replace("<?php echo base_url()?>index.php/finance/password/");
				</script>
				<?php
			}

	}
}
