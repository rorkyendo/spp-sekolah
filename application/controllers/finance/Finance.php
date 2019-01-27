<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {

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
		$this->session->set_userdata('menu','finance');
		$this->load->model('finance/finance_model', 'dbObject');
		$this->user_id = $this->session->userdata('user_id');
  }

	public function school_fees()
	{
		$data['title']='Pembayaran SPP';
    $data['submenu']='spp';
		$data['first_day_this_month'] = date('Y-m-01');
		$data['last_day_this_month']  = date('Y-m-t');
		$data['jurusan'] = $this->dbObject->get_general('ws_major');
		$this->load->view('finance/templates/header');
		$this->load->view('finance/templates/sidebar',$data);
		$this->load->view('finance/spp/index',$data);
		$this->load->view('finance/templates/modal');
		$this->load->view('finance/templates/footer');
	}

	public function list_data_school_fees($param1='',$param2='')
	{
		if($param1=='search'){
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$major_id = $this->input->get('major');
			$class = $this->input->get('class');
			$data['spp'] = $this->dbObject->get_school_fees_by_detail($start_date,$end_date,$major_id,$class);
			$this->load->view('finance/spp/list',$data);
		}else{
			$data['first_day_this_month'] = date('Y-m-01');
			$data['last_day_this_month']  = date('Y-m-t');
			$data['spp'] = $this->dbObject->get_school_fees($data['first_day_this_month'],$data['last_day_this_month']);
			$this->load->view('finance/spp/list',$data);
		}
	}

	public function school_fees_create($param1='',$param2='')
	{
		if($param1=='do_create')
		{
			$id_siswa = $this->input->post('id_siswa');
			$payment_date = $this->input->post('payment_date');
			$nominal = $this->input->post('nominal');
			$nominal = str_replace(".","",$nominal);

			$payment_info = array(
				'id_siswa' => $id_siswa,
				'nominal' => $nominal,
				'payment_date' => $payment_date,
				'approved_by' => $this->user_id
			);

			$data_siswa = $this->dbObject->get_by_id_general('ws_siswa','id',$id_siswa);
			foreach ($data_siswa as $key) {
				$name = $key->name;
			}

			$this->dbObject->create_general('ws_school_fees',$payment_info);
			$approval_code = $this->db->insert_id();
			$approval_code = 'SF'.$approval_code;

			$finance_info = array(
				'approval_code' => $approval_code,
				'cash_in' => $nominal,
				'cash_out' => 0,
				'description' => 'Pembayaran uang sekolah '.$name.' tanggal ('.$payment_date.')',
				'created_by' => $this->user_id,
				'status' => 1
			);

			$this->dbObject->create_general('ws_finance',$finance_info);
			$this->session->set_flashdata('notif','<div class="alert alert-success">Data pembayaran uang sekolah berhasil dimasukkan. Terimakasih.</div>');
			redirect('finance/finance/school_fees');

		}else {
		$data['title']='Pembayaran SPP';
		$data['submenu']='spp';
		$data['today']=date('Y-m-d');
		$this->load->view('finance/templates/header');
		$this->load->view('finance/templates/sidebar',$data);
		$this->load->view('finance/spp/payment',$data);
		$this->load->view('finance/templates/footer');
		}
	}

	public function spp_update($param1='',$param2='')
	{
		$data['spp'] = $this->dbObject->get_by_id_general('ws_school_fees','id_sf',$param1);
		$this->load->view('finance/spp/update', $data);
		if($param2=='do_update')
		{
			$payment_date = $this->input->post('payment_date');
			$nominal = $this->input->post('nominal');
			$nominal = str_replace(".","",$nominal);
			$data_spp = array(
				'payment_date' => $payment_date,
				'nominal' => $nominal,
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => $this->user_id
			);
			$this->dbObject->update_general('ws_school_fees','id_sf',$param1,$data_spp);

			$data_finance = array(
				'cash_in' => $nominal,
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => $this->user_id
			);

			$this->dbObject->update_general('ws_finance','approval_code',"SF".$param1,$data_finance);
			$this->session->set_flashdata('notif','<div class="alert alert-success">Data pembayaran uang sekolah berhasil diedit. Terimakasih.</div>');
			redirect('finance/finance/school_fees');
		}
	}

	public function spp_delete($param1='',$param2='')
	{
		if($this->dbObject->delete_general('ws_school_fees', 'id_sf', $param1)===TRUE)
		{
			if($this->dbObject->delete_general('ws_finance', 'approval_code', "SF".$param1)===TRUE)
			{
				?>
				<script>
					alert(" Data berhasil dihapus. ");
					location.replace("<?php echo base_url()?>index.php/finance/finance/school_fees");
				</script>
				<?php
			}
		}
		else {
			?>
			<script>
				alert(" Data gagal dihapus. ");
				location.replace("<?php echo base_url()?>index.php/finance/finance/school_fees");
			</script>
			<?php
		}
	}

	public function debit()
	{
		$data['title']='Pemasukan';
    $data['submenu']='debit';
		$data['first_day_this_month'] = date('Y-m-01');
		$data['last_day_this_month']  = date('Y-m-t');
		$data['debit'] = $this->dbObject->get_general('ws_finance');
		$this->load->view('finance/templates/header');
		$this->load->view('finance/templates/sidebar',$data);
		$this->load->view('finance/debit/index',$data);
		$this->load->view('finance/templates/modal');
		$this->load->view('finance/templates/footer');
	}

	public function list_data_debit($param1='',$param2='')
	{
		if($param1=='search'){
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$data['debit'] = $this->dbObject->get_debit_by_date($start_date,$end_date);
			$this->load->view('finance/debit/list',$data);
		}else{
			$data['first_day_this_month'] = date('Y-m-01');
			$data['last_day_this_month']  = date('Y-m-t');
			$data['debit'] = $this->dbObject->get_debit_by_date($data['first_day_this_month'],$data['last_day_this_month']);
			$this->load->view('finance/debit/list',$data);
		}
	}

	public function debit_create($param1='',$param2='')
	{
		if($param1=='do_create')
		{
			$approval_code = $this->input->post('approval_code');
			$approval_code = strtoupper($approval_code);
			$description = $this->input->post('description');
			$payment_date = $this->input->post('payment_date');
			$nominal = $this->input->post('nominal');
			$nominal = str_replace(".","",$nominal);
			$result = $this->dbObject->get_by_id_general('ws_finance','approval_code',$approval_code);
			if($result==true)
			{
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Data debit gagal dibuat, kode approval sudah digunakan</div>');
				redirect('finance/finance/debit');
			}else{
				$finance_info = array(
					'approval_code' => $approval_code,
					'description' => $description,
					'created_time' => $payment_date,
					'cash_in' => $nominal,
					'created_by' => $this->user_id,
					'status' => 1
				);
				$this->dbObject->create_general('ws_finance',$finance_info);
				$this->session->set_flashdata('notif','<div class="alert alert-success">Data debit berhasil dimasukkan</div>');
				redirect('finance/finance/debit');
			}
		}else {
		$data['title']='Input data debit';
		$data['submenu']='Input data debit';
		$data['today']=date('Y-m-d');
		$this->load->view('finance/templates/header');
		$this->load->view('finance/templates/sidebar',$data);
		$this->load->view('finance/debit/payment',$data);
		$this->load->view('finance/templates/footer');
		}
	}

	public function debit_update($param1='',$param2='')
	{
		$data['debit'] = $this->dbObject->get_by_id_general('ws_finance','id_finance',$param1);
		$this->load->view('finance/debit/update', $data);
		if($param2=='do_update')
		{
			$payment_date = $this->input->post('payment_date');
			$nominal = $this->input->post('nominal');
			$nominal = str_replace(".","",$nominal);
			$data_finance = array(
				'cash_in' => $nominal,
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => $this->user_id
			);
			$this->dbObject->update_general('ws_finance','id_finance',$param1,$data_finance);

			$this->session->set_flashdata('notif','<div class="alert alert-success">Data pemasukan berhasil diedit. Terimakasih.</div>');
			redirect('finance/finance/school_fees');
		}
	}

	public function debit_delete($param1='',$param2='')
	{
		if($this->dbObject->delete_general('ws_finance', 'id_finance', $param1)===TRUE)
		{
				?>
				<script>
					alert(" Data berhasil dihapus. ");
					location.replace("<?php echo base_url()?>index.php/finance/finance/debit");
				</script>
				<?php
		}
		else {
			?>
			<script>
				alert(" Data gagal dihapus. ");
				location.replace("<?php echo base_url()?>index.php/finance/finance/debit");
			</script>
			<?php
		}
	}

	public function kredit()
	{
		$data['title']='Pengeluaran';
    $data['submenu']='kredit';
		$data['first_day_this_month'] = date('Y-m-01');
		$data['last_day_this_month']  = date('Y-m-t');
		$data['kredit'] = $this->dbObject->get_general('ws_finance');
		$this->load->view('finance/templates/header');
		$this->load->view('finance/templates/sidebar',$data);
		$this->load->view('finance/kredit/index',$data);
		$this->load->view('finance/templates/modal');
		$this->load->view('finance/templates/footer');
	}

	public function list_data_kredit($param1='',$param2='')
	{
		if($param1=='search'){
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$data['kredit'] = $this->dbObject->get_kredit_by_date($start_date,$end_date);
			$this->load->view('finance/kredit/list',$data);
		}else{
			$data['first_day_this_month'] = date('Y-m-01');
			$data['last_day_this_month']  = date('Y-m-t');
			$data['kredit'] = $this->dbObject->get_kredit_by_date($data['first_day_this_month'],$data['last_day_this_month']);
			$this->load->view('finance/kredit/list',$data);
		}
	}

	public function kredit_create($param1='',$param2='')
	{
		if($param1=='do_create')
		{
			$approval_code = $this->input->post('approval_code');
			$approval_code = strtoupper($approval_code);
			$description = $this->input->post('description');
			$payment_date = $this->input->post('payment_date');
			$nominal = $this->input->post('nominal');
			$nominal = str_replace(".","",$nominal);
			$result = $this->dbObject->get_by_id_general('ws_finance','approval_code',$approval_code);
			if($result==true)
			{
				$this->session->set_flashdata('notif','<div class="alert alert-danger">Data kredit gagal dibuat, kode approval sudah digunakan</div>');
				redirect('finance/finance/kredit');
			}else{
				$finance_info = array(
					'approval_code' => $approval_code,
					'description' => $description,
					'created_time' => $payment_date,
					'cash_out' => $nominal,
					'created_by' => $this->user_id,
					'status' => 0
				);
				$this->dbObject->create_general('ws_finance',$finance_info);
				$this->session->set_flashdata('notif','<div class="alert alert-success">Data kredit berhasil dimasukkan</div>');
				redirect('finance/finance/kredit');
			}
		}else {
		$data['title']='Input data kredit';
		$data['submenu']='Input data kredit';
		$data['today']=date('Y-m-d');
		$this->load->view('finance/templates/header');
		$this->load->view('finance/templates/sidebar',$data);
		$this->load->view('finance/kredit/payment',$data);
		$this->load->view('finance/templates/footer');
		}
	}

	public function kredit_update($param1='',$param2='')
	{
		$data['kredit'] = $this->dbObject->get_by_id_general('ws_finance','id_finance',$param1);
		$this->load->view('finance/kredit/update', $data);
		if($param2=='do_update')
		{
			$payment_date = $this->input->post('payment_date');
			$nominal = $this->input->post('nominal');
			$nominal = str_replace(".","",$nominal);
			$data_finance = array(
				'cash_out' => $nominal,
				'updated_time' => date('Y-m-d H:i:s'),
				'updated_by' => $this->user_id
			);
			$this->dbObject->update_general('ws_finance','id_finance',$param1,$data_finance);

			$this->session->set_flashdata('notif','<div class="alert alert-success">Data pengeluaran berhasil diedit. Terimakasih.</div>');
			redirect('finance/finance/kredit');
		}
	}

	public function kredit_delete($param1='',$param2='')
	{
		if($this->dbObject->delete_general('ws_finance', 'id_finance', $param1)===TRUE)
		{
				?>
				<script>
					alert(" Data berhasil dihapus. ");
					location.replace("<?php echo base_url()?>index.php/finance/finance/kredit");
				</script>
				<?php
		}
		else {
			?>
			<script>
				alert(" Data gagal dihapus. ");
				location.replace("<?php echo base_url()?>index.php/finance/finance/kredit");
			</script>
			<?php
		}
	}

	public function report()
	{
		$data['title']='Laporan Keuangan';
		$data['submenu']='Laporan Keuangan';
		$data['first_day_this_month'] = date('Y-m-01');
		$data['last_day_this_month']  = date('Y-m-t');
		$data['report'] = $this->dbObject->get_general('ws_finance');
		$this->load->view('finance/templates/header');
		$this->load->view('finance/templates/sidebar',$data);
		$this->load->view('finance/report/index',$data);
		$this->load->view('finance/templates/modal');
		$this->load->view('finance/templates/footer');
	}

	public function list_data_report($param1='',$param2='')
	{
		if($param1=='search'){
			$start_date = $this->input->get('start_date');
			$end_date = $this->input->get('end_date');
			$data['report'] = $this->dbObject->get_report_by_date($start_date,$end_date);
			$this->load->view('finance/report/list',$data);
		}else{
			$data['first_day_this_month'] = date('Y-m-01');
			$data['last_day_this_month']  = date('Y-m-t');
			$data['report'] = $this->dbObject->get_report_by_date($data['first_day_this_month'],$data['last_day_this_month']);
			$this->load->view('finance/report/list',$data);
		}
	}

	public function check_approval_code()
	{
		$approval_code = $this->input->get('approval_code');
		$approval_code = strtoupper($approval_code);

		$result = $this->dbObject->get_by_id_general('ws_finance','approval_code',$approval_code);
		if($result==true)
		{
			echo "sama";
		}else {
			echo "beda";
		}
	}

}
