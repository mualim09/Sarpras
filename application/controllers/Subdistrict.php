<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subdistrict extends CI_Controller {

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
        $query = "select * from ref_subdistrict order by SUBDISTRICT ";
        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "subdistrict";
        $content['contentheader'] = "Data Kecamatan";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"subdistrict"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li class='active'> Data Kecamatan</li>";
        $content['content'] = $this->load->view('subdistrict/index',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function entryadd(){
		$subdistrict['SUBDISTRICTID'] = "";
		$subdistrict['SUBDISTRICT'] = "";
		$data['data'] = $subdistrict;
        
        // $content['currentpage'] = "subdistrict";
        $content['contentheader'] = "Tambah Data Kecamatan";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"subdistrict"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Kecamatan</a></li><li class='active'> Tambah Data Kecamatan</li>";
        $content['content'] = $this->load->view('subdistrict/add',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function entryedit($subdistrictid){
		$query = "select * from ref_subdistrict where SUBDISTRICTID = '$subdistrictid'";
		$result = $this->modelsip4->get_data($query);

		$subdistrict['SUBDISTRICTID'] = $result[0]['SUBDISTRICTID'];
		$subdistrict['SUBDISTRICT'] = $result[0]['SUBDISTRICT'];
		$data['data'] = $subdistrict;
        
        // $content['currentpage'] = "subdistrict";
        $content['contentheader'] = "Ubah Data Kecamatan";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"subdistrict"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Kecamatan</a></li><li class='active'> Ubah Data Kecamatan</li>";
        $content['content'] = $this->load->view('subdistrict/edit',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function add(){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_subdistrict','Kecamatan','required|is_unique[ref_subdistrict.SUBDISTRICT]');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$subdistrict['SUBDISTRICTID'] = NULL;
				$subdistrict['SUBDISTRICT'] = $this->input->post('txt_subdistrict');
				$data['data'] = $subdistrict;
		        
		        // $content['currentpage'] = "subdistrict";
		        $content['contentheader'] = "Tambah Data Kecamatan";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"subdistrict"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Kecamatan</a></li><li class='active'> Tambah Data Kecamatan</li>";
		        $content['content'] = $this->load->view('subdistrict/add',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['SUBDISTRICT'] = strtoupper($this->input->post('txt_subdistrict'));
				$res=$this->modelsip4->add_data('ref_subdistrict',$data);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data '.strtoupper($this->input->post('txt_subdistrict')).' berhasil ditambahkan');
					redirect('subdistrict/entryadd');
				}else{
					$this->session->set_flashdata('erroralert','Data '.strtoupper($this->input->post('txt_subdistrict')).' gagal ditambahkan. Pesan error : '.$this->db->_error_message());
					redirect('subdistrict/entryadd');
				}
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('subdistrict');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function edit($subdistrictid){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_subdistrict','Kecamatan','required|is_unique[ref_subdistrict.SUBDISTRICT]');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$subdistrict['SUBDISTRICTID'] = $subdistrictid;
				$subdistrict['SUBDISTRICT'] = $this->input->post('txt_subdistrict');
				$data['data'] = $subdistrict;
		        
		        // $content['currentpage'] = "subdistrict";
		        $content['contentheader'] = "Ubah Data Kecamatan";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"subdistrict"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Master</a></li><li><a href='#'> Data Kecamatan</a></li><li class='active'> Ubah Data Kecamatan</li>";
		        $content['content'] = $this->load->view('subdistrict/edit',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['SUBDISTRICT'] = strtoupper($this->input->post('txt_subdistrict'));
				$where['SUBDISTRICTID'] = $subdistrictid;
				$res=$this->modelsip4->edit_data('ref_subdistrict',$data,$where);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data dengan id '.$subdistrictid.' berhasil diubah');
					redirect('subdistrict');
				}else{
					$this->session->set_flashdata('erroralert','Data dengan id '.$subdistrictid.' gagal diubah. Pesan error : '.$this->db->_error_message());
					redirect('subdistrict');
				}			
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('subdistrict');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function delete($subdistrictid){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$where['SUBDISTRICTID'] = $subdistrictid;
		$res=$this->modelsip4->delete_data('ref_subdistrict',$where);
		if($res>=1){
			$this->session->set_flashdata('successalert','Data dengan id '.$subdistrictid.' berhasil dihapus');
			redirect('subdistrict');
		}else{
			$this->session->set_flashdata('erroralert','Data dengan id '.$subdistrictid.' gagal dihapus. Pesan error : '.$this->db->_error_message());
			redirect('subdistrict');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}
}
