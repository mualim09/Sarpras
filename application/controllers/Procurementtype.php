<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurementtype extends CI_Controller {

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
        $query = "select * from ref_procurementtype order by PROCTYPECODE ";
        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "procurementtype";
        $content['contentheader'] = "Data Tipe Pengadaan";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurementtype"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li class='active'> Data Tipe Pengadaan</li>";
        $content['content'] = $this->load->view('procurementtype/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

	public function entryadd(){
		$query = "select CONCAT('PL',LPAD(COALESCE((MAX(SUBSTRING(PROCTYPECODE,3))+1), 1), 2, '0')) as PROCTYPECODE from ref_procurementtype";
		$result = $this->modelsip4->get_data($query);

		$procurementtype['PROCTYPECODE'] = $result[0]['PROCTYPECODE'];
		$procurementtype['PROCTYPEDESC'] = "";
		$data['data'] = $procurementtype;
        
        // $content['currentpage'] = "procurementtype";
        $content['contentheader'] = "Tambah Data Tipe Pengadaan";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurementtype"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Tipe Pengadaan</a></li><li class='active'> Tambah Data Tipe Pengadaan</li>";
        $content['content'] = $this->load->view('procurementtype/add',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function entryedit($proctypecode){
		$query = "select * from ref_procurementtype where PROCTYPECODE = '$proctypecode'";
		$result = $this->modelsip4->get_data($query);

		$procurementtype['PROCTYPECODE'] = $result[0]['PROCTYPECODE'];
		$procurementtype['PROCTYPEDESC'] = $result[0]['PROCTYPEDESC'];
		$data['data'] = $procurementtype;
        
        // $content['currentpage'] = "procurementtype";
        $content['contentheader'] = "Ubah Data Tipe Pengadaan";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurementtype"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Tipe Pengadaan</a></li><li class='active'> Ubah Data Tipe Pengadaan</li>";
        $content['content'] = $this->load->view('procurementtype/edit',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function add(){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_proctypecode','Kode','required|is_unique[ref_procurementtype.PROCTYPECODE]');
		$this->form_validation->set_rules('txt_proctypedesc','Tipe Pengadaan','required|is_unique[ref_procurementtype.PROCTYPEDESC]');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$procurementtype['PROCTYPECODE'] = $this->input->post('txt_proctypecode');
				$procurementtype['PROCTYPEDESC'] = $this->input->post('txt_proctypedesc');
				$data['data'] = $procurementtype;
		        
		        // $content['currentpage'] = "procurementtype";
		        $content['contentheader'] = "Tambah Data Tipe Pengadaan";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurementtype"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Tipe Pengadaan</a></li><li class='active'> Tambah Data Tipe Pengadaan</li>";
		        $content['content'] = $this->load->view('procurementtype/add',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['PROCTYPECODE'] = strtoupper($this->input->post('txt_proctypecode'));
				$data['PROCTYPEDESC'] = strtoupper($this->input->post('txt_proctypedesc'));
				$res=$this->modelsip4->add_data('ref_procurementtype',$data);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data '.strtoupper($this->input->post('txt_proctypecode')).' berhasil ditambahkan');
					redirect('procurementtype/entryadd');
				}else{
					$this->session->set_flashdata('erroralert','Data '.strtoupper($this->input->post('txt_proctypecode')).' gagal ditambahkan. Pesan error : '.$this->db->_error_message());
					redirect('procurementtype/entryadd');
				}		
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('procurementtype');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function edit($proctypecode){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_proctypecode','Kode','required');
		$this->form_validation->set_rules('txt_proctypedesc','Tipe Pengadaan','required|is_unique[ref_procurementtype.PROCTYPEDESC]');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$procurementtype['PROCTYPECODE'] = $proctypecode;
				$procurementtype['PROCTYPEDESC'] = $this->input->post('txt_proctypedesc');
				$data['data'] = $procurementtype;
		        
		        // $content['currentpage'] = "procurementtype";
		        $content['contentheader'] = "Ubah Data Tipe Pengadaan";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurementtype"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Tipe Pengadaan</a></li><li class='active'> Ubah Data Tipe Pengadaan</li>";
		        $content['content'] = $this->load->view('procurementtype/edit',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['PROCTYPEDESC'] = strtoupper($this->input->post('txt_proctypedesc'));
				$where['PROCTYPECODE'] = $proctypecode;
				$res=$this->modelsip4->edit_data('ref_procurementtype',$data,$where);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data dengan kode '.$proctypecode.' berhasil diubah');
					redirect('procurementtype');
				}else{
					$this->session->set_flashdata('erroralert','Data dengan kode '.$proctypecode.' gagal diubah. Pesan error : '.$this->db->_error_message());
					redirect('procurementtype');
				}			
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('procurementtype');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function delete($proctypecode){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$where['PROCTYPECODE'] = $proctypecode;
		$res=$this->modelsip4->delete_data('ref_procurementtype',$where);
		if($res>=1){
			$this->session->set_flashdata('successalert','Data dengan kode '.$proctypecode.' berhasil dihapus');
			redirect('procurementtype');
		}else{
			$this->session->set_flashdata('erroralert','Data dengan id '.$proctypecode.' gagal dihapus. Pesan error : '.$this->db->_error_message());
			redirect('procurementtype');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}
}
