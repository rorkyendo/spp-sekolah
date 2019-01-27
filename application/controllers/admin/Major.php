<?php
/*
	This fiture is under construction
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Major extends CI_Controller {

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
		$this->session->set_userdata('menu','registration');
		$this->load->model('admin/major_model', 'dbObject');
  }

  public $tbl = 'ws_major';
	public $id_name = 'major_id';

	public function index()
	{
		$data['title']='Admin Registration';
		$data['jurusan'] = $this->dbObject->get_major();
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar',$data);
		$this->load->view('admin/major/index', $data);
		$this->load->view('admin/templates/modal');
		$this->load->view('admin/templates/footer');
	}

	public function create($param1='')
	{
		$data['pegawai'] = $this->dbObject->get_general($this->tbl);
		$this->session->set_userdata('submenu','tambah');
		$data['posisi'] = $this->dbObject->get_general('ws_group');
		$data['title']='Admin Registration';
		$this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar',$data);
		$this->load->view('admin/registration/create', $data);
		$this->load->view('admin/templates/footer');
		if ($param1 == 'do_create') {
			$new = $this->input->post('username');
			$q = $this->dbObject->get_username_pegawai($new);

			if($q == TRUE){
				 ?>
					 <script>
								 alert(" Username telah digunakan");
								 location.replace("<?php echo base_url()?>index.php/admin/registration/create");
					 </script>
				 <?php
		 	}
		}
	}

	public function update($param2='', $param1='')
	{
		$data['pegawai'] = $this->dbObject->get_pegawai_by_id($param2);
		$data['posisi'] = $this->dbObject->get_general('ws_group');

		$this->load->view('admin/registration/update', $data);

		if ($param1 == 'do_update') {
			$birth_date = $this->input->post('birth_date');
			$gender = $this->input->post('gender');
			$group_id = $this->input->post('group_id');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			$kota = $this->input->post('kota');
			$telepon = $this->input->post('telepon');
			$name = $this->input->post('name');
			$status = $this->input->post('status');

			foreach ($data['pegawai'] as $key) {
				$nip = $key->nip;
			}

			$config['upload_path']          = 'assets/img/foto/pegawai';
			$config['allowed_types']        = 'gif|jpg|jpeg|png';
			$config['max_size']             = 10000;
			$config['file_name'] = $nip;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('profile_picture'))
			{
					 $data = array(
						 'name' => $name,
						 'email' => $email,
						 'alamat' => $alamat,
						 'telepon' => $telepon,
						 'birth_date' => date('Y-m-d',strtotime($birth_date)),
						 'joined_date' => date('Y-m-d'),
						 'gender' => $gender,
						 'kota' => $kota,
						 'group_id' => $group_id
					 );
				}else{
					//--------------------- Menghapus Foto lama -----------------------//
					$datapegawai = $this->dbObject->get_pegawai_by_id($param2);
					foreach ($datapegawai as $key){
						if($key->profile_picture!='assets/img/avatar04.png'){
						unlink($key->profile_picture);
						}
					}
					//------------------ End of Menghapus Foto lama ---------------------//

					$data = array(
						'name' => $name,
						'email' => $email,
						'alamat' => $alamat,
						'telepon' => $telepon,
						'birth_date' => date('Y-m-d',strtotime($birth_date)),
						'gender' => $gender,
						'joined_date' => date('Y-m-d'),
						'profile_picture' => $config['upload_path']."/".$this->upload->data('file_name'),
						'kota' => $kota,
						'group_id' => $group_id
					);
			}
			if($this->dbObject->update_general($this->tbl, $this->id_name, $param2, $data)===TRUE)		// using direct parameter
			{
				$datausers = array(
				'users_status_active'=> $status,
				);
				if($this->dbObject->update_general($this->tbl2, $this->id_name2 , $param2, $datausers)===TRUE){		// using direct parameter
				?>
				<script>
					alert(" Data berhasil diubah. ");
					location.replace("<?php echo base_url()?>index.php/admin/registration/");
				</script>
				<?php
			}
			else {
				?>
				<script>
					alert(" Data gagal diubah. ");
					location.replace("<?php echo base_url()?>index.php/admin/registration/");
				</script>
				<?php
			}
		}
	}
}

		public function delete($param2='')
	{
		$data['pegawai'] = $this->dbObject->get_pegawai_by_id($param2);
		foreach ($data['pegawai'] as $key){
			if($key->profile_picture!='assets/img/avatar04.png'){
			unlink(base_url()."/".$key->profile_picture);
			}
		}
		if($this->dbObject->delete_general($this->tbl, $this->id_name, $param2)===TRUE)		// using direct parameter
		{
			if($this->dbObject->delete_general($this->tbl2, $this->id_name2, $param2)===TRUE)		// using direct parameter
			{
				?>
				<script>
					alert(" Data berhasil dihapus. ");
					location.replace("<?php echo base_url()?>index.php/admin/registration");
				</script>
				<?php
			}	//redirect('backoffice/master/category','refresh');
		}
		else {
			?>
			<script>
				alert(" Data gagal dihapus. ");
				location.replace("<?php echo base_url()?>index.php/admin/registration");
			</script>
			<?php
			//redirect('backoffice/master/category','refresh');
		}
	}

	public function detail($param1='')
	{
		$data['pegawai'] = $this->dbObject->get_pegawai_by_id($param1);
		$data['posisi'] = $this->dbObject->get_general('ws_group');
		$this->load->view('admin/registration/detail', $data);
	}

}
