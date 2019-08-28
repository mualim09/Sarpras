<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supervisor extends CI_Controller {

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
        $query = "select * from ref_supervisor where SVCODE != 'ADMIN' order by SVCODE ";
        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "supervisor";
        $content['contentheader'] = "Data Konsultan Pengawas";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"supervisor"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li class='active'> Data Konsultan Pengawas</li>";
        $content['content'] = $this->load->view('supervisor/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

	public function entryadd(){
		$query = "select CONCAT('SV',LPAD(COALESCE((MAX(SUBSTRING(SVCODE,3))+1), 1), 6, '0')) as SVCODE from ref_supervisor where SVCODE like 'SV%'";
		$result = $this->modelsip4->get_data($query);

		$supervisor['SVCODE'] = $result[0]['SVCODE'];
		$supervisor['SVNAME'] = "";
		$supervisor['SVADDRESS'] = "";
		$supervisor['SVPHONENUMBER'] = "";
		$data['data'] = $supervisor;
        
        // $content['currentpage'] = "supervisor";
        $content['contentheader'] = "Tambah Konsultan Pengawas";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"supervisor"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Konsultan Pengawas</a></li><li class='active'> Tambah Data Konsultan Pengawas</li>";
        $content['content'] = $this->load->view('supervisor/add',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function entryedit($svcode){
		$query = "select * from ref_supervisor where SVCODE = '$svcode'";
		$result = $this->modelsip4->get_data($query);

		$supervisor['SVCODE'] = $result[0]['SVCODE'];
		$supervisor['SVNAME'] = $result[0]['SVNAME'];
		$supervisor['SVADDRESS'] = $result[0]['SVADDRESS'];
		$supervisor['SVPHONENUMBER'] = $result[0]['SVPHONENUMBER'];
		$data['data'] = $supervisor;
        
        // $content['currentpage'] = "supervisor";
        $content['contentheader'] = "Ubah Data Konsultan Pengawas";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"supervisor"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Konsultan Pengawas</a></li><li class='active'> Ubah Data Konsultan Pengawas</li>";
        $content['content'] = $this->load->view('supervisor/edit',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function add(){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_svcode','Kode','required|is_unique[ref_supervisor.SVCODE]');
		$this->form_validation->set_rules('txt_svname','Nama','required');
		// $this->form_validation->set_rules('txt_address','Alamat','required|is_unique[ref_userprofile.ADDRESS]');
		// $this->form_validation->set_rules('txt_phonenumber','No. Telepon','required|is_unique[ref_userprofile.PHONENUMBER]');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$supervisor['SVCODE'] = $this->input->post('txt_svcode');
				$supervisor['SVNAME'] = $this->input->post('txt_svname');
				$supervisor['SVADDRESS'] = $this->input->post('txt_svaddress');
				$supervisor['SVPHONENUMBER'] = $this->input->post('txt_svphonenumber');
				$data['data'] = $supervisor;

		        // $content['currentpage'] = "supervisor";
		        $content['contentheader'] = "Tambah Data Konsultan Pengawas";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"supervisor"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Konsultan Pengawas</a></li><li class='active'> Tambah Data Konsultan Pengawas</li>";
		        $content['content'] = $this->load->view('supervisor/add',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['SVCODE'] = strtoupper($this->input->post('txt_svcode'));
				$data['SVNAME'] = strtoupper($this->input->post('txt_svname'));
				$data['SVADDRESS'] = strtoupper($this->input->post('txt_svaddress'));
				$data['SVPHONENUMBER'] = $this->input->post('txt_svphonenumber');
				$res=$this->modelsip4->add_data('ref_supervisor',$data);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data '.strtoupper($this->input->post('txt_svcode')).' berhasil ditambahkan');
					redirect('supervisor/entryadd');
				}else{
					$this->session->set_flashdata('erroralert','Data '.strtoupper($this->input->post('txt_svcode')).' gagal ditambahkan. Pesan error : '.$this->db->_error_message());
					redirect('supervisor/entryadd');
				}		
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('supervisor');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function edit($svcode){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_svcode','Kode','required');
		$this->form_validation->set_rules('txt_svname','Nama','required');
		// $this->form_validation->set_rules('txt_address','Alamat','required|is_unique[ref_userprofile.ADDRESS]');
		// $this->form_validation->set_rules('txt_phonenumber','No. Telepon','required|is_unique[ref_userprofile.PHONENUMBER]');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$supervisor['SVCODE'] = $svcode;
				$supervisor['SVNAME'] = $this->input->post('txt_svname');
				$supervisor['SVADDRESS'] = $this->input->post('txt_svaddress');
				$supervisor['SVPHONENUMBER'] = $this->input->post('txt_svphonenumber');
				$data['data'] = $supervisor;
		        
		        // $content['currentpage'] = "supervisor";
		        $content['contentheader'] = "Ubah Data Konsultan Pengawas";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"supervisor"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Konsultan Pengawas</a></li><li class='active'> Ubah Data Konsultan Pengawas</li>";
		        $content['content'] = $this->load->view('supervisor/edit',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['SVNAME'] = strtoupper($this->input->post('txt_svname'));
				$data['SVADDRESS'] = strtoupper($this->input->post('txt_svaddress'));
				$data['SVPHONENUMBER'] = $this->input->post('txt_svphonenumber');
				$where['SVCODE'] = $svcode;
				$res=$this->modelsip4->edit_data('ref_supervisor',$data,$where);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data dengan kode '.$svcode.' berhasil diubah');
					redirect('supervisor');
				}else{
					$this->session->set_flashdata('erroralert','Data dengan kode '.$svcode.' gagal diubah. Pesan error : '.$this->db->_error_message());
					redirect('supervisor');
				}			
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('supervisor');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function delete($svcode){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$where['SVCODE'] = $svcode;
		$res=$this->modelsip4->delete_data('ref_supervisor',$where);
		if($res>=1){
			$this->session->set_flashdata('successalert','Data dengan kode '.$svcode.' berhasil dihapus');
			redirect('supervisor');
		}else{
			$this->session->set_flashdata('erroralert','Data dengan kode '.$svcode.' gagal dihapus. Pesan error : '.$this->db->_error_message());
			redirect('supervisor');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}
}
