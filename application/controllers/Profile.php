<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
    	if ($this->session->userdata('login') == 0 || $this->session->userdata('user_level') != '2') redirect('auth/logout');
			$this->session->set_userdata('menu','register');
			$this->load->model('profile_model', 'dbObject');
			$this->id = $this->session->userdata('user_id');
    }

  public $tbl = 'ws_pegawai';
	public $id_name = 'id';
	public $tbl2 = 'ws_users';
	public $id_name2 = 'users_id';

	public function index()
	{
		$data['profile'] = $this->dbObject->get_profile($this->id);
		$data['content']='profile_pegawai';
		$data['media_limit_3'] = $this->dbObject->get_media_limit_3();
		$this->load->view('templates/header');
		$this->load->view('templates/navbar');
		$this->load->view('welcome',$data);
		$this->load->view('templates/footer',$data);
	}


	public function update($param1='',$param2='')
	{
		$pegawai_password=md5($this->input->post('password'));
		$pegawai_name=$this->input->post('name');
		$pegawai_email=$this->input->post('email');
		$pegawai_alamat=$this->input->post('alamat');
		$pegawai_telepon=$this->input->post('telepon');
		$pegawai_kota=$this->input->post('kota');

		$data = array(
			'password' => $pegawai_password,
			'name' => $pegawai_name,
			'email' => $pegawai_email,
			'alamat' => $pegawai_alamat,
			'telepon' => $pegawai_telepon,
			'kota' => $pegawai_kota,
			'update_time' => date('Y-m-d H:i:s'),
			'update_by' => $this->session->userdata('user_id')
		);

		if($this->dbObject->update_general($this->tbl, $this->id_name, $param1, $data)===TRUE)		// using direct parameter
			{

				$datausers = array(
				'users_username' => $admin_usersname,
				);

				if($this->dbObject->update_general($this->tbl2, $this->id_name2 , $param2, $datausers)===TRUE){		// using direct parameter
					$this->session->set_userdata('user_name',$pegawai_name);
				?>
				<script>
					alert(" Data berhasil diubah. ");
					location.replace("<?php echo base_url()?>index.php/profile/");
				</script>
				<?php
				//redirect('master/jabatan','refresh');
			}
			else {
				?>
				<script>
					alert(" Data gagal diubah. ");
					location.replace("<?php echo base_url()?>index.php/profile/");
				</script>
				<?php
				//redirect('master/jabatan_insert','refresh');
			}
		}

	}
}
