<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provider extends CI_Controller {

	var $nav;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('USERNAME') ==''){
            redirect('login');
		}else{
			$return = $this->uauth->check_superadmin();

			if($return == FALSE){
				$this->session->set_flashdata('erroralert', 'Maaf, Anda tidak memiliki akses untuk halaman tersebut');
				if($this->session->userdata('USERNAME') ==''){
		            redirect('login');
				}else{
					redirect('dashboard');
				}
			}
			
			$this->load->model('modelsip4');

			if($this->session->userdata('LEVEL') == 'SUPERADMIN'){
				$this->nav = "navigation/superadmin";
			}
			if($this->session->userdata('LEVEL') == 'ADMINSD' || $this->session->userdata('LEVEL') == 'ADMINSMP' || $this->session->userdata('LEVEL') == 'ADMINSMA'){
				$this->nav = "navigation/admin";
			}
			if($this->session->userdata('LEVEL') == 'USER'){
				$this->nav = "navigation/user";
			}
		}
	}
	public function index(){
        $query = "select * from ref_provider order by PVCODE ";
        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "provider";
        $content['contentheader'] = "Data Penyedia Jasa";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"provider"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li class='active'> Data Penyedia Jasa</li>";
        $content['content'] = $this->load->view('provider/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

	public function entryadd(){
		$query = "select CONCAT('PV',LPAD(COALESCE((MAX(SUBSTRING(PVCODE,3))+1), 1), 6, '0')) as PVCODE from ref_provider";
		$result = $this->modelsip4->get_data($query);

		$provider['PVCODE'] = $result[0]['PVCODE'];
		$provider['PVNAME'] = "";
		$provider['PVADDRESS'] = "";
		$provider['PVPHONENUMBER'] = "";
		$data['data'] = $provider;
        
        // $content['currentpage'] = "provider";
        $content['contentheader'] = "Tambah Data Penyedia Jasa";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"provider"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Penyedia Jasa</a></li><li class='active'> Tambah Data Penyedia Jasa</li>";
        $content['content'] = $this->load->view('provider/add',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function entryedit($pvcode){
		$query = "select * from ref_provider where PVCODE = '$pvcode'";
		$result = $this->modelsip4->get_data($query);

		$provider['PVCODE'] = $result[0]['PVCODE'];
		$provider['PVNAME'] = $result[0]['PVNAME'];
		$provider['PVADDRESS'] = $result[0]['PVADDRESS'];
		$provider['PVPHONENUMBER'] = $result[0]['PVPHONENUMBER'];
		$data['data'] = $provider;
        
        // $content['currentpage'] = "provider";
        $content['contentheader'] = "Ubah Data Penyedia Jasa";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"provider"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Penyedia Jasa</a></li><li class='active'> Ubah Data Penyedia Jasa</li>";
        $content['content'] = $this->load->view('provider/edit',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function add(){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_pvcode','Kode','required|is_unique[ref_provider.PVCODE]');
		$this->form_validation->set_rules('txt_pvname','Nama','required');
		// $this->form_validation->set_rules('txt_address','Alamat','required|is_unique[ref_userprofile.ADDRESS]');
		// $this->form_validation->set_rules('txt_phonenumber','No. Telepon','required|is_unique[ref_userprofile.PHONENUMBER]');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$provider['PVCODE'] = $this->input->post('txt_pvcode');
				$provider['PVNAME'] = $this->input->post('txt_pvname');
				$provider['PVADDRESS'] = $this->input->post('txt_pvaddress');
				$provider['PVPHONENUMBER'] = $this->input->post('txt_pvphonenumber');
				$data['data'] = $provider;

		        // $content['currentpage'] = "provider";
		        $content['contentheader'] = "Tambah Data Penyedia Jasa";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"provider"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Penyedia Jasa</a></li><li class='active'> Tambah Data Penyedia Jasa</li>";
		        $content['content'] = $this->load->view('provider/add',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['PVCODE'] = strtoupper($this->input->post('txt_pvcode'));
				$data['PVNAME'] = strtoupper($this->input->post('txt_pvname'));
				$data['PVADDRESS'] = strtoupper($this->input->post('txt_pvaddress'));
				$data['PVPHONENUMBER'] = $this->input->post('txt_pvphonenumber');
				$res=$this->modelsip4->add_data('ref_provider',$data);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data '.strtoupper($this->input->post('txt_pvcode')).' berhasil ditambahkan');
					redirect('provider/entryadd');
				}else{
					$this->session->set_flashdata('erroralert','Data '.strtoupper($this->input->post('txt_pvcode')).' gagal ditambahkan. Pesan error : '.$this->db->_error_message());
					redirect('provider/entryadd');
				}		
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('provider');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function edit($pvcode){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_pvcode','Kode','required');
		$this->form_validation->set_rules('txt_pvname','Nama','required');
		// $this->form_validation->set_rules('txt_address','Alamat','required|is_unique[ref_userprofile.ADDRESS]');
		// $this->form_validation->set_rules('txt_phonenumber','No. Telepon','required|is_unique[ref_userprofile.PHONENUMBER]');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$provider['PVCODE'] = $pvcode;
				$provider['PVNAME'] = $this->input->post('txt_pvname');
				$provider['PVADDRESS'] = $this->input->post('txt_pvaddress');
				$provider['PVPHONENUMBER'] = $this->input->post('txt_pvphonenumber');
				$data['data'] = $provider;
		        
		        // $content['currentpage'] = "provider";
		        $content['contentheader'] = "Ubah Data Penyedia Jasa";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"provider"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Penyedia Jasa</a></li><li class='active'> Ubah Data Penyedia Jasa</li>";
		        $content['content'] = $this->load->view('provider/edit',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['PVNAME'] = strtoupper($this->input->post('txt_pvname'));
				$data['PVADDRESS'] = strtoupper($this->input->post('txt_pvaddress'));
				$data['PVPHONENUMBER'] = $this->input->post('txt_pvphonenumber');
				$where['PVCODE'] = $pvcode;
				$res=$this->modelsip4->edit_data('ref_provider',$data,$where);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data dengan kode '.$pvcode.' berhasil diubah');
					redirect('provider');
				}else{
					$this->session->set_flashdata('erroralert','Data dengan kode '.$pvcode.' gagal diubah. Pesan error : '.$this->db->_error_message());
					redirect('provider');
				}			
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('provider');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function delete($pvcode){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$where['PVCODE'] = $pvcode;
		$res=$this->modelsip4->delete_data('ref_provider',$where);
		if($res>=1){
			$this->session->set_flashdata('successalert','Data dengan kode '.$pvcode.' berhasil dihapus');
			redirect('provider');
		}else{
			$this->session->set_flashdata('erroralert','Data dengan kode '.$pvcode.' gagal dihapus. Pesan error : '.$this->db->_error_message());
			redirect('provider');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}
}
