<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

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
			$this->session->set_userdata('menu','registration');
			$this->load->model('finance/registration_model', 'dbObject');
	  }

	  public $tbl = 'ws_siswa';
		public $id_name = 'id';
		public $tbl2 = 'ws_users';
		public $id_name2 = 'users_user_id';

		public function index()
		{
			$data['siswa'] = $this->dbObject->get_siswa();
			$data['jurusan'] = $this->dbObject->get_general('ws_major');
			$data['title'] = 'Pendaftaran Siswa';
			$this->load->view('finance/templates/header');
			$this->load->view('finance/templates/sidebar',$data);
			$this->load->view('finance/registration/index', $data);
			$this->load->view('finance/templates/modal');
			$this->load->view('finance/templates/footer');
		}

		public function list_data($param1='')
		{
			if($param1=='search'){
				$major	= $this->input->post('major');
				$class	=	$this->input->post('class');
				$keyword = $this->input->post('keyword');
				$data['siswa'] = $this->dbObject->get_siswa_search($major,$class,$keyword);
			}else{
			$data['title']='Pendaftaran Siswa';
			$data['siswa'] = $this->dbObject->get_siswa();
			$data['jurusan'] = $this->dbObject->get_general('ws_major');
			}
			$this->load->view('finance/registration/list',$data);
		}

		public function create($param1='')
		{
			$this->session->set_userdata('submenu','tambah');
			$data['jurusan'] = $this->dbObject->get_general('ws_major');
			$data['title'] = 'Pendaftaran Siswa';
			$this->load->view('finance/templates/header');
			$this->load->view('finance/templates/sidebar',$data);
			$this->load->view('finance/registration/create', $data);
			$this->load->view('finance/templates/footer');

			if ($param1 == 'do_create'){
				$name = $this->input->post('name');
				$birth_date = $this->input->post('birth_date');
				$gender = $this->input->post('gender');
				$major_id = $this->input->post('major_id');
				$email = $this->input->post('email');
				$alamat = $this->input->post('alamat');
				$telepon = $this->input->post('telepon');
				$nisn = $this->input->post('nisn');
				$f = $this->dbObject->get_nisn($nisn);
				$kota = $this->input->post('kota');
				$register_year = $this->input->post('register_year');
				$parent_name = $this->input->post('parent_name');
				$class = $this->input->post('class');
				$q = $this->dbObject->get_username_siswa($nisn);

				$config['upload_path']          = 'assets/img/foto/siswa';
				$config['allowed_types']        = 'gif|jpg|jpeg|png';
				$config['max_size']             = 10000;
				$config['file_name']             = $nisn;
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('profile_picture'))
				{
			       $data = array(
							 'password' => md5(date('Y-m-d',strtotime($birth_date))),
							 'name' => $name,
							 'nisn' => $nisn,
							 'email' => $email,
							 'alamat' => $alamat,
							 'telepon' => $telepon,
							 'birth_date' => date('Y-m-d',strtotime($birth_date)),
							 'gender' => $gender,
							 'kota' => $kota,
							 'parent_name' => $parent_name,
							 'register_year' => $register_year,
							 'class' => $class,
							 'major_id' => $major_id,
						 );
					}else{
						$data = array(
							'password' => md5(date('Y-m-d',strtotime($birth_date))),
							'name' => $name,
							'nisn' => $nisn,
							'email' => $email,
							'alamat' => $alamat,
							'birth_date' => date('Y-m-d',strtotime($birth_date)),
							'telepon' => $telepon,
							'parent_name' => $parent_name,
							'gender' => $gender,
							'profile_picture' => $config['upload_path']."/".$this->upload->data('file_name'),
							'kota' => $kota,
							'register_year' => $register_year,
							'class' => $class,
							'major_id' => $major_id,
						);
					}
				 if($f == TRUE){
		 				?>
			 				<script>
					 					alert("NISN telah digunakan");
										location.replace("<?php echo base_url()?>index.php/finance/registration/create");
		 					</script>
						<?php
				}
				elseif($q == TRUE){
					 ?>
						 <script>
									 alert(" Username telah digunakan");
									 location.replace("<?php echo base_url()?>index.php/finance/registration/create");
						 </script>
					 <?php
			 }
				elseif ($q == FALSE && $f == FALSE) {
						if($this->dbObject->create_general($this->tbl, $data)===TRUE)		// using direct parameter
						{
							$datausers = array(
							'users_username' => $nisn,
							'users_user_id' => $this->db->insert_id(),
							'users_role_id' => '3',
							'users_status_active'=> '1',
							'users_created_time'=> date('Y-m-d H:i:s'),
							'users_created_by'=> $this->session->userdata('user_id')
							);
							if($this->dbObject->create_general('ws_users', $datausers)===TRUE){		// using direct parameter
							?>
							<script>
								alert(" Data berhasil disimpan. ");
								location.replace("<?php echo base_url()?>index.php/finance/registration/");
							</script>
							<?php
						}
						else {
							?>
							<script>
								alert(" Data gagal disimpan. ");
								location.replace("<?php echo base_url()?>index.php/finance/registration/");
							</script>
							<?php
						}
					}
				}
			}
		}

		public function update($param2='', $param1='')
		{
			$data['siswa'] = $this->dbObject->get_siswa_by_id($param2);
			$data['jurusan'] = $this->dbObject->get_general('ws_major');
			$this->load->view('finance/registration/update', $data);
			if ($param1 == 'do_update') {
				$name = $this->input->post('name');
				$birth_date = $this->input->post('birth_date');
				$gender = $this->input->post('gender');
				$major_id = $this->input->post('major_id');
				$email = $this->input->post('email');
				$alamat = $this->input->post('alamat');
				$telepon = $this->input->post('telepon');
				$nisn = $this->input->post('nisn');
				$f = $this->dbObject->get_nisn($nisn);
				$kota = $this->input->post('kota');
				$register_year = $this->input->post('register_year');
				$parent_name = $this->input->post('parent_name');
				$class = $this->input->post('class');
				$q = $this->dbObject->get_username_siswa($nisn);
				$status = $this->input->post('status');
				$config['upload_path']          = 'assets/img/foto/siswa';
				$config['allowed_types']        = 'gif|jpg|jpeg|png';
				$config['max_size']             = 10000;
				$config['file_name']             = $nisn;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('profile_picture'))
				{
						 $data = array(
							 'name' => $name,
							 'nisn' => $nisn,
							 'email' => $email,
							 'alamat' => $alamat,
							 'telepon' => $telepon,
							 'birth_date' => date('Y-m-d',strtotime($birth_date)),
							 'gender' => $gender,
							 'kota' => $kota,
							 'parent_name' => $parent_name,
							 'register_year' => $register_year,
							 'class' => $class,
							 'major_id' => $major_id,
						 );
					}else{
						//--------------------- Menghapus Foto lama -----------------------//
						$datasiswa = $this->dbObject->get_siswa_by_id($param2);
						foreach ($datasiswa as $key){
							if($key->profile_picture!='assets/img/avatar04.png'){
							unlink($key->profile_picture);
							}
						}
						//------------------ End of Menghapus Foto lama ---------------------//
						$data = array(
							'name' => $name,
							'nisn' => $nisn,
							'email' => $email,
							'alamat' => $alamat,
							'birth_date' => date('Y-m-d',strtotime($birth_date)),
							'telepon' => $telepon,
							'parent_name' => $parent_name,
							'gender' => $gender,
							'profile_picture' => $config['upload_path']."/".$this->upload->data('file_name'),
							'kota' => $kota,
							'register_year' => $register_year,
							'class' => $class,
							'major_id' => $major_id,
						);
					}
				if($this->dbObject->update_general($this->tbl, $this->id_name, $param2, $data)===TRUE)		// using direct parameter
				{
					$datausers = array(
					'users_status_active'=> $status,
					);
					if($this->dbObject->update_general($this->tbl2, $this->id_name2 , $param2, $datausers)===TRUE){		// using direct parameter
					?>
					?>
					<script>
						alert(" Data berhasil diubah. ");
						location.replace("<?php echo base_url()?>index.php/finance/registration/");
					</script>
					<?php
				}
				else {
					?>
					<script>
						alert(" Data gagal diubah. ");
						location.replace("<?php echo base_url()?>index.php/finance/registration/");
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
					location.replace("<?php echo base_url()?>index.php/finance/registration");
				</script>
				<?php
			}	//redirect('backoffice/master/category','refresh');
		}
		else {
			?>
			<script>
				alert(" Data gagal dihapus. ");
				location.replace("<?php echo base_url()?>index.php/finance/registration");
			</script>
			<?php
			//redirect('backoffice/master/category','refresh');
		}
	}

	public function detail($param1='')
	{
		$data['siswa'] = $this->dbObject->get_siswa_by_id($param1);
		$data['jurusan'] = $this->dbObject->get_general('ws_major');
		$this->load->view('finance/registration/detail', $data);
	}

	function get_data_siswa($param1='',$param2='')
	{
		if($param1=='major'){
			$data['jurusan'] = $this->dbObject->get_general('ws_major');
			echo json_encode($data['jurusan']);
		}elseif ($param1=='search') {
			$class	=	$this->input->get('class');
			$major	=	$this->input->get('major');
			$keyword = $this->input->get('keyword');
			$data['siswa'] = $this->dbObject->get_siswa_search($major,$class,$keyword);
			echo json_encode($data['siswa']);
		}
	}

}
