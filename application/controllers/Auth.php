<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
			$this->session->set_userdata('menu','login');
    	$this->load->model('auth_model', 'dbObject');
    }

	public function index()
	{
		if ($this->session->userdata('login') == 1){
			if($this->session->userdata('user_level') == '1')
				redirect('admin/dashboard','refresh');
			// else if($this->session->userdata('user_level') == '2')
			// 	redirect('pegawai/dashboard','refresh');
		}

		$this->session->set_userdata('menu','login');
		redirect(base_url());
	}

	public function login()
	{
		$username=$this->input->post('username');
		$password=md5($this->input->post('password'));
		$uresult = $this->dbObject->get_user($username);

		//---------------------------------- LOGIN LOGIC -------------------------------//

		if (count($uresult) > 0)
		{
			foreach ($uresult as $row)
			{
				$this->session->set_userdata('user_id', $row->users_id);
		    $this->session->set_userdata('user_level', $row->users_role_id);
		    $this->session->set_userdata('login', 1);
		    $this->session->set_userdata('user_status', $row->users_status_active);
				$this->session->set_userdata('profile_id', $row->users_user_id);

				//------------------------------- Login Admin ------------------------------//
				if($row->users_role_id == 1){
					$result = $this->dbObject->get_password($password, 'ws_admin');
					if($result==TRUE)
					{
						@$name = $result->name;
						$profile_picture = $result->profile_picture;
						if ($row->users_status_active) {
							$this->session->set_userdata('user_name', $name);
							$this->session->set_userdata('profile_picture', $profile_picture);
							redirect('admin/dashboard','refresh');
						}
						else {
							$this->session->set_userdata('login', 0);
							echo "<script> alert('Akun Belum Di Verifikasi'); </script>";
							redirect(base_url().'index.php/auth','refresh');
						}
					}
					else
					{
						$this->session->set_userdata('login', 0);
						echo "<script> alert('Username and Password Salah...'); </script>";
						redirect(base_url().'index.php/auth','refresh');
					}
				}
				//------------------------------- END OF Login Admin ------------------------------//

				//------------------------------- Login pegawai ------------------------------//
				else if($row->users_role_id == 2){
					$result = $this->dbObject->get_password($password, 'ws_pegawai');
					if($result)
					{
						$profile_picture = $result->profile_picture;
						$group_id = $result->group_id;
						@$name = $result->name;
						$data_pegawai = array(
							'user_name' => $name,
							'profile_picture' => $profile_picture,
							'group_id' => $group_id
						);
						if ($row->users_status_active == 1) {
							$this->session->set_userdata($data_pegawai);
							//------------------- Login Operator -------------------------//
							if($group_id==1){
								redirect(base_url(),'refresh');
							}
							//------------------ End of Login Operator ------------------//
							//------------------- Login Keuangan -------------------------//
							if($group_id==2){
								redirect('finance/dashboard','refresh');
							}
							//------------------ End of Login Keuangan ------------------//
							//------------------- Login Guru -------------------------//
							if($group_id==3){
								redirect(base_url(),'refresh');
							}
							//------------------ End of Login Guru ------------------//
						}
						else {
							$this->session->set_userdata('login', 0);
							echo "<script> alert('Username dan password salah'); </script>";
							redirect(base_url().'index.php/auth','refresh');
						}
					}
					else
					{
						$this->session->set_userdata('login', 0);
						echo "<script> alert('Username and Password Salah...'); </script>";
						redirect(base_url().'index.php/auth','refresh');
					}
				}
				//------------------------------- Login pegawai ------------------------------//
			}

			//----------------------------------- END OF LOGIN LOGIC --------------------------------//

		}
		else
		{	$this->session->set_userdata('login', 0);
			echo "<script> alert('Username and Password Salah...'); </script>";
            redirect(base_url().'index.php/auth','refresh');
			//echo "Error :";
		}

	}

	public function logout()
	{
		$this->session->set_userdata('login', 0);
		$this->session->sess_destroy();
    $this->session->set_flashdata('logout_notification', 'logged_out');
		redirect(base_url(),'refresh');
	}

}
