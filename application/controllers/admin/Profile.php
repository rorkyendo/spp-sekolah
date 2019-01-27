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
    if($this->session->userdata('login') == 0 || $this->session->userdata('user_level') != '1') redirect('auth/logout');
		$this->session->set_userdata('menu','profile');
		$this->load->model('admin/profile_model', 'dbObject');
		$this->id = $this->session->userdata('user_id');
  }

  public $tbl = 'ws_admin';
	public $id_name = 'id';
	public $tbl2 = 'ws_users';
	public $id_name2 = 'users_id';

	public function index()
	{
		$data['title']='Admin Profile';
		$data['profile'] = $this->dbObject->get_profile($this->id);
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar',$data);
		$this->load->view('admin/profile/index',$data);
		$this->load->view('admin/templates/footer');
	}


	public function update($param1='',$param2='')
	{
		$admin_name=$this->input->post('name');
		$admin_usersname=$this->input->post('usersname');
		$config['upload_path']          = 'assets/img/foto/admin';
		$config['allowed_types']        = 'gif|jpg|jpeg|png';
		$config['max_size']             = 10000;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('profile_picture'))
		{
			$data = array(
				'name' => $admin_name,
			);
		}else {
			$data = array(
				'name' => $admin_name,
				'profile_picture' => $config['upload_path']."/".$this->upload->data('file_name')
			);
		}
			//------------------- Menghapus gambar lama ----------------------//
			$admin = $this->dbObject->get_by_id_general('ws_admin','id',$param1);
			foreach ($admin as $key) {
				$profile_picture = $key->profile_picture;
			}
			unlink($profile_picture);
			//----------------- End of Menghapus gambar lama ---------------//

		if($this->dbObject->update_general($this->tbl, $this->id_name, $param1, $data)===TRUE)		// using direct parameter
			{

				$datausers = array(
				'users_username' => $admin_usersname,
				);

				if($this->dbObject->update_general($this->tbl2, $this->id_name2 , $param2, $datausers)===TRUE){		// using direct parameter
					$this->session->set_userdata('user_name',$admin_name);
				?>
				<script>
					alert(" Data berhasil diubah. ");
					location.replace("<?php echo base_url()?>index.php/admin/profile/");
				</script>
				<?php
				//redirect('master/jabatan','refresh');
			}
			else {
				?>
				<script>
					alert(" Data gagal diubah. ");
					location.replace("<?php echo base_url()?>index.php/admin/profile/");
				</script>
				<?php
				//redirect('master/jabatan_insert','refresh');
			}
		}

	}
}
