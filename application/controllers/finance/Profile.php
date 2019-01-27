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
		if($this->session->userdata('login') == 0 || $this->session->userdata('user_level') != '2' && $this->session->userdata('group_id') != '2') redirect('auth/logout');
		$this->session->set_userdata('menu','profile');
		$this->load->model('finance/profile_model', 'dbObject');
		$this->id = $this->session->userdata('user_id');
  }

  public $tbl = 'ws_pegawai';
	public $id_name = 'id';
	public $tbl2 = 'ws_users';
	public $id_name2 = 'users_id';

	public function index()
	{
		$data['title']='Finance Profile';
		$data['posisi'] = $this->dbObject->get_general('ws_group');
		$data['profile'] = $this->dbObject->get_profile($this->id);
		$this->load->view('finance/templates/header');
		$this->load->view('finance/templates/sidebar',$data);
		$this->load->view('finance/profile/index',$data);
		$this->load->view('finance/templates/footer');
	}


	public function update($param1='',$param2='')
	{
		$name = $this->input->post('name');
		$usersname = $this->input->post('usersname');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
		$kota = $this->input->post('kota');
		$telepon = $this->input->post('telepon');
		$gender = $this->input->post('gender');
		$status = $this->input->post('status');
		$birth_date = $this->input->post('birth_date');
		$nip = $this->input->post('nip');
		$q = $this->dbObject->get_username_pegawai($usersname);

		$config['upload_path']          = 'assets/img/foto/pegawai';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 10000;
		$config['file_name']						= $nip;

		$this->load->library('upload', $config);
		if($q == TRUE){
			 ?>
				 <script>
							 alert(" Username telah digunakan");
							 location.replace("<?php echo base_url()?>index.php/finance/profile");
				 </script>
			 <?php
	 }elseif($q == FALSE){
		if (!$this->upload->do_upload('profile_picture'))
		{
			$data = array(
				'name' => $name,
				'email' => $email,
				'alamat' => $alamat,
				'telepon' => $telepon,
				'birth_date' => date('Y-m-d',strtotime($birth_date)),
				'gender' => $gender,
				'kota' => $kota,
			);
		}else {
			//------------------- Menghapus gambar lama ----------------------//
			$pegawai = $this->dbObject->get_by_id_general('ws_pegawai','id',$param1);
			foreach ($pegawai as $key) {
				$profile_picture = $key->profile_picture;
			}
			unlink($profile_picture);
			//----------------- End of Menghapus gambar lama ---------------//

			$data = array(
				'name' => $name,
				'email' => $email,
				'alamat' => $alamat,
				'telepon' => $telepon,
				'birth_date' => date('Y-m-d',strtotime($birth_date)),
				'gender' => $gender,
				'kota' => $kota,
				'profile_picture' => $config['upload_path']."/".$this->upload->data('file_name')
			);
		}

		if($this->dbObject->update_general($this->tbl, $this->id_name, $param1, $data)===TRUE)		// using direct parameter
			{

				$datausers = array(
				'users_username' => $usersname,
				);

				if($this->dbObject->update_general($this->tbl2, $this->id_name2 , $param2, $datausers)===TRUE){		// using direct parameter
					$this->session->set_userdata('user_name',$name);
				?>
				<script>
					alert(" Data berhasil diubah. ");
					location.replace("<?php echo base_url()?>index.php/finance/profile/");
				</script>
				<?php
				//redirect('master/jabatan','refresh');
			}
			else {
				?>
				<script>
					alert(" Data gagal diubah. ");
					location.replace("<?php echo base_url()?>index.php/finance/profile/");
				</script>
				<?php
				//redirect('master/jabatan_insert','refresh');
				}
			}
		}
	}

}
