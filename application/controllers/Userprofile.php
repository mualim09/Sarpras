<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userprofile extends CI_Controller {

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
        $query = "select rup.USERCODE as USERCODE, rup.NAME as NAME, rup.ADDRESS as ADDRESS, rup.PHONENUMBER as PHONENUMBER, rup.SVCODE as SVCODE, rs.SVNAME as SVNAME from ref_userprofile rup left join ref_supervisor rs on rs.SVCODE = rup.SVCODE order by USERCODE ";
        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "userprofile";
        $content['contentheader'] = "Data Profil User";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"userprofile"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Sistem</a></li><li class='active'> Data Profil User</li>";
        $content['content'] = $this->load->view('userprofile/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

	public function entryadd(){
		$query = "select CONCAT('UP',LPAD(COALESCE((MAX(SUBSTRING(USERCODE,3))+1), 1), 6, '0')) as USERCODE from ref_userprofile";
		$result = $this->modelsip4->get_data($query);

		$query2 = "select * from ref_supervisor order by SVNAME";
		$result2 = $this->modelsip4->get_data($query2);

		$userprofile['USERCODE'] = $result[0]['USERCODE'];
		$userprofile['NAME'] = "";
		$userprofile['ADDRESS'] = "";
		$userprofile['PHONENUMBER'] = "";
		$userprofile['SVCODE'] = "";
		$userprofile['supervisorlist'] = $result2;
		$data['data'] = $userprofile;
        
        // $content['currentpage'] = "userprofile";
        $content['contentheader'] = "Tambah Data Profil User";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"userprofile"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Sistem</a></li><li><a href='#'> Data Profil User</a></li><li class='active'> Tambah Data Profil User</li>";
        $content['content'] = $this->load->view('userprofile/add',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function entryedit($usercode){
		$query = "select * from ref_userprofile where USERCODE = '$usercode'";
		$result = $this->modelsip4->get_data($query);

		$query2 = "select * from ref_supervisor order by SVNAME";
		$result2 = $this->modelsip4->get_data($query2);

		$userprofile['USERCODE'] = $result[0]['USERCODE'];
		$userprofile['NAME'] = $result[0]['NAME'];
		$userprofile['ADDRESS'] = $result[0]['ADDRESS'];
		$userprofile['PHONENUMBER'] = $result[0]['PHONENUMBER'];
		$userprofile['SVCODE'] = $result[0]['SVCODE'];
		$userprofile['supervisorlist'] = $result2;
		$data['data'] = $userprofile;
        
        // $content['currentpage'] = "userprofile";
        $content['contentheader'] = "Ubah Data Profil User";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"userprofile"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Sistem</a></li><li><a href='#'> Data Profil User</a></li><li class='active'> Ubah Data Profil User</li>";
        $content['content'] = $this->load->view('userprofile/edit',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function add(){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_usercode','Kode User','required|is_unique[ref_userprofile.USERCODE]');
		$this->form_validation->set_rules('txt_name','Nama','required');
		// $this->form_validation->set_rules('txt_address','Alamat','required|is_unique[ref_userprofile.ADDRESS]');
		// $this->form_validation->set_rules('txt_phonenumber','No. Telepon','required|is_unique[ref_userprofile.PHONENUMBER]');
		$this->form_validation->set_rules('cmb_sv','Konsultan Pengawas','required');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$query2 = "select * from ref_supervisor order by SVNAME";
				$result2 = $this->modelsip4->get_data($query2);

				$userprofile['USERCODE'] = $this->input->post('txt_usercode');
				$userprofile['NAME'] = $this->input->post('txt_name');
				$userprofile['ADDRESS'] = $this->input->post('txt_address');
				$userprofile['PHONENUMBER'] = $this->input->post('txt_phonenumber');
				$userprofile['SVCODE'] = $this->input->post('cmb_sv');
				$userprofile['supervisorlist'] = $result2;
				$data['data'] = $userprofile;

		        // $content['currentpage'] = "userprofile";
		        $content['contentheader'] = "Tambah Data Profil User";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"userprofile"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Sistem</a></li><li><a href='#'> Data Profil User</a></li><li class='active'> Tambah Data Profil User</li>";
		        $content['content'] = $this->load->view('userprofile/add',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['USERCODE'] = strtoupper($this->input->post('txt_usercode'));
				$data['NAME'] = strtoupper($this->input->post('txt_name'));
				$data['ADDRESS'] = strtoupper($this->input->post('txt_address'));
				$data['PHONENUMBER'] = $this->input->post('txt_phonenumber');
				$data['SVCODE'] = strtoupper($this->input->post('cmb_sv'));
				$res=$this->modelsip4->add_data('ref_userprofile',$data);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data '.strtoupper($this->input->post('txt_usercode')).' berhasil ditambahkan');
					redirect('userprofile/entryadd');
				}else{
					$this->session->set_flashdata('erroralert','Data '.strtoupper($this->input->post('txt_usercode')).' gagal ditambahkan. Pesan error : '.$this->db->_error_message());
					redirect('userprofile/entryadd');
				}		
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('userprofile');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function edit($usercode){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_usercode','Kode User','required');
		$this->form_validation->set_rules('txt_name','Nama','required');
		// $this->form_validation->set_rules('txt_address','Alamat','required|is_unique[ref_userprofile.ADDRESS]');
		// $this->form_validation->set_rules('txt_phonenumber','No. Telepon','required|is_unique[ref_userprofile.PHONENUMBER]');
		$this->form_validation->set_rules('cmb_sv','Konsultan Pengawas','required');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$query2 = "select * from ref_supervisor order by SVNAME";
				$result2 = $this->modelsip4->get_data($query2);

				$userprofile['USERCODE'] = $usercode;
				$userprofile['NAME'] = $this->input->post('txt_name');
				$userprofile['ADDRESS'] = $this->input->post('txt_address');
				$userprofile['PHONENUMBER'] = $this->input->post('txt_phonenumber');
				$userprofile['SVCODE'] = $this->input->post('cmb_sv');
				$userprofile['supervisorlist'] = $result2;
				$data['data'] = $userprofile;
		        
		        // $content['currentpage'] = "userprofile";
		        $content['contentheader'] = "Ubah Data Profil User";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"userprofile"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Sistem</a></li><li><a href='#'> Data Profil User</a></li><li class='active'> Ubah Data Profil User</li>";
		        $content['content'] = $this->load->view('userprofile/edit',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['NAME'] = strtoupper($this->input->post('txt_name'));
				$data['ADDRESS'] = strtoupper($this->input->post('txt_address'));
				$data['PHONENUMBER'] = $this->input->post('txt_phonenumber');
				$data['SVCODE'] = strtoupper($this->input->post('cmb_sv'));
				$where['USERCODE'] = $usercode;
				$res=$this->modelsip4->edit_data('ref_userprofile',$data,$where);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data dengan kode '.$usercode.' berhasil diubah');
					redirect('userprofile');
				}else{
					$this->session->set_flashdata('erroralert','Data dengan kode '.$usercode.' gagal diubah. Pesan error : '.$this->db->_error_message());
					redirect('userprofile');
				}			
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('userprofile');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function delete($usercode){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$where['USERCODE'] = $usercode;
		$res=$this->modelsip4->delete_data('ref_userprofile',$where);
		if($res>=1){
			$this->session->set_flashdata('successalert','Data dengan kode '.$usercode.' berhasil dihapus');
			redirect('userprofile');
		}else{
			$this->session->set_flashdata('erroralert','Data dengan kode '.$usercode.' gagal dihapus. Pesan error : '.$this->db->_error_message());
			redirect('userprofile');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}
}
