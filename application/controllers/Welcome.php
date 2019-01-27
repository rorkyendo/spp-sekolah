<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 *///
	public function __construct()
    {
			parent::__construct();
			$this->load->model('welcome_model', 'dbObject');
			$this->session->set_userdata('menu','home');
			$this->session->set_userdata('search',FALSE);
    }

	public function index()
	{
		$data['media'] = $this->dbObject->get_media_limit();
		$data['media_category'] = $this->dbObject->get_media_category();
		$data['media_limit_3'] = $this->dbObject->get_media_limit_3();
		$data['content'] = 'landingpage';
		$this->load->view('templates/header');
		$this->load->view('templates/navbar');
		$this->load->view('templates/masterslider',$data);
		$this->load->view('welcome', $data);
		$this->load->view('templates/footer',$data);
	}

	public function blog_grid($cat_id)
	{
		$data['media'] = $this->dbObject->get_media_by_category_id_limit_one($cat_id);
		$this->load->view('blog_grid',$data);
	}

	public function kirim()
	{
		$kontak_name_pengirim=trim($this->input->post('kontak_name'));
		$kontak_email_pengirim=trim($this->input->post('kontak_email'));
		$kontak_subjek=trim($this->input->post('kontak_subjek'));
		$kontak_isi=$this->input->post('kontak_isi');
		$data = array(
			'kontak_name_pengirim' => $kontak_name_pengirim,
			'kontak_email_pengirim' => $kontak_email_pengirim,
			'kontak_subjek' => $kontak_subjek,
			'kontak_isi' => $kontak_isi,
			'kontak_insert_date' => date('Y-m-d H:i:s')
		);
		if($this->dbObject->create_general('ws_kontak', $data)===TRUE)		// using direct parameter
		{
			?>
			<script>
				location.replace("<?php echo base_url()?>");
				alert(" Pesan berhasil dikirim. ");
			</script>
			<?php
		}
		else {
			?>
			<script>
				location.replace("<?php echo base_url()?>");
				alert(" Pesan gagal dikirim. ");
			</script>
			<?php
		}
	}

}
