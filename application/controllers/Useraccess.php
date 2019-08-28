<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useraccess extends CI_Controller {

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
        $query = "select sua.USERCODE as USERCODE, rup.NAME as NAME, sua.USERNAME as USERNAME, sua.PASSWORD as PASSWORD, sua.LEVEL as LEVEL, if(sua.STATUS = '1', 'ONLINE', 'OFFLINE') as STATUS, sua.SESSIONID as SESSIONID, sua.LASTLOGIN as LASTLOGIN from sys_useraccess sua left join ref_userprofile rup on sua.USERCODE = rup.USERCODE order by sua.USERCODE ";
        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "useraccess";
        $content['contentheader'] = "Data Akses User";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"useraccess"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Sistem</a></li><li class='active'> Data Akses User</li>";
        $content['content'] = $this->load->view('useraccess/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

	public function entryadd(){
		$query = "select CONCAT('user',LPAD(COALESCE((MAX(SUBSTRING(USERNAME,5))+1), 1), 4, '0')) as USERNAME from sys_useraccess where USERNAME like 'user%'";
		$result = $this->modelsip4->get_data($query);

		$query2 = "select * from ref_userprofile order by NAME";
		$result2 = $this->modelsip4->get_data($query2);

		$useraccess['USERNAME'] = $result[0]['USERNAME'];
		$useraccess['PASSWORD'] = "";
		$useraccess['LEVEL'] = "";
		$useraccess['USERCODE'] = "";
		$useraccess['userlist'] = $result2;
		$data['data'] = $useraccess;

		// echo "<pre>";
		// die(print_r($data, TRUE));
        
        // $content['currentpage'] = "useraccess";
        $content['contentheader'] = "Tambah Data Akses User";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"useraccess"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Sistem</a></li><li><a href='#'> Data Akses User</a></li><li class='active'> Tambah Akses Profil User</li>";
        $content['content'] = $this->load->view('useraccess/add',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function entryedit($username){
		$this->load->library('cipher');
		$cipher = new Cipher(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		 
		$key = "1qaz2WSX#edc";
		
		$query = "select * from sys_useraccess where USERNAME = '$username'";
		$result = $this->modelsip4->get_data($query);

		$query2 = "select * from ref_userprofile order by NAME";
		$result2 = $this->modelsip4->get_data($query2);

		$useraccess['USERNAME'] = $result[0]['USERNAME'];
		// $useraccess['PASSWORD'] = $this->encryption->decrypt($result[0]['PASSWORD']);
		$useraccess['PASSWORD'] = $cipher->decrypt($result[0]['PASSWORD'], $key);
		$useraccess['LEVEL'] = $result[0]['LEVEL'];
		$useraccess['USERCODE'] = $result[0]['USERCODE'];
		$useraccess['userlist'] = $result2;
		$data['data'] = $useraccess;
        
        // $content['currentpage'] = "useraccess";
        $content['contentheader'] = "Ubah Data Akses User";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"useraccess"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Sistem</a></li><li><a href='#'> Data Akses User</a></li><li class='active'> Ubah Data Akses User</li>";
        $content['content'] = $this->load->view('useraccess/edit',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function add(){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		// require_once("Cipher.php");
		$this->load->library('cipher');
		$cipher = new Cipher(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		 
		$key = "1qaz2WSX#edc";
		// $string="sembunyikan aku";
		 
		// $en = $cipher->encrypt($string, $key);
		// $de = $cipher->decrypt($en, $key);
		 
		// echo "Enkrispi Kata : $string <br>";
		// echo "Hasil Enkripsi : $en <br>";
		// echo "Hasil Dekrispi : $de <br>";

		// die();

		$this->form_validation->set_rules('txt_username','Username','required|is_unique[sys_useraccess.USERNAME]');
		$this->form_validation->set_rules('txt_password','Password','required');
		$this->form_validation->set_rules('cmb_level','Level','required');
		$this->form_validation->set_rules('cmb_usercode','User','required');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$query2 = "select * from ref_userprofile order by NAME";
				$result2 = $this->modelsip4->get_data($query2);

				$useraccess['USERNAME'] = $this->input->post('txt_username');
				$useraccess['PASSWORD'] = $this->input->post('txt_password');
				$useraccess['LEVEL'] = $this->input->post('cmb_level');
				$useraccess['USERCODE'] = $this->input->post('cmb_usercode');
				$useraccess['userlist'] = $result2;
				$data['data'] = $useraccess;

		        // $content['currentpage'] = "useraccess";
		        $content['contentheader'] = "Tambah Data Akses User";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"useraccess"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Sistem</a></li><li><a href='#'> Data Akses User</a></li><li class='active'> Tambah Data Akses User</li>";
		        $content['content'] = $this->load->view('useraccess/add',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['USERNAME'] = $this->input->post('txt_username');
				$data['PASSWORD'] = $cipher->encrypt($this->input->post('txt_password'), $key);
				// $data['PASSWORD'] = $this->input->post('txt_password');
				$data['LEVEL'] = strtoupper($this->input->post('cmb_level'));
				$data['STATUS'] = 0;
				$data['USERCODE'] = strtoupper($this->input->post('cmb_usercode'));
				$res=$this->modelsip4->add_data('sys_useraccess',$data);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data '.$this->input->post('txt_username').' berhasil ditambahkan');
					redirect('useraccess/entryadd');
				}else{
					$this->session->set_flashdata('erroralert','Data '.$this->input->post('txt_username').' gagal ditambahkan. Pesan error : '.$this->db->_error_message());
					redirect('useraccess/entryadd');
				}		
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('useraccess');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function edit($username){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->load->library('cipher');
		$cipher = new Cipher(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		 
		$key = "1qaz2WSX#edc";

		$this->form_validation->set_rules('txt_username','Username','required');
		$this->form_validation->set_rules('txt_password','Password','required');
		$this->form_validation->set_rules('cmb_level','Level','required');
		$this->form_validation->set_rules('cmb_usercode','User','required');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$query2 = "select * from ref_userprofile order by NAME";
				$result2 = $this->modelsip4->get_data($query2);

				$useraccess['USERNAME'] = $this->input->post('txt_username');
				$useraccess['PASSWORD'] = $this->input->post('txt_password');
				$useraccess['LEVEL'] = $this->input->post('cmb_level');
				$useraccess['USERCODE'] = $this->input->post('cmb_usercode');
				$useraccess['userlist'] = $result2;
				$data['data'] = $useraccess;
		        
		        // $content['currentpage'] = "useraccess";
		        $content['contentheader'] = "Ubah Data Akses User";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"useraccess"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Sistem</a></li><li><a href='#'> Data Akses User</a></li><li class='active'> Ubah Data Akses User</li>";
		        $content['content'] = $this->load->view('useraccess/edit',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['PASSWORD'] = $cipher->encrypt($this->input->post('txt_password'), $key);
				// $data['PASSWORD'] = $this->input->post('txt_password');
				$data['LEVEL'] = strtoupper($this->input->post('cmb_level'));
				$data['USERCODE'] = strtoupper($this->input->post('cmb_usercode'));
				$where['USERNAME'] = $username;
				$res=$this->modelsip4->edit_data('sys_useraccess',$data,$where);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data '.$username.' berhasil diubah');
					redirect('useraccess');
				}else{
					$this->session->set_flashdata('erroralert','Data '.$username.' gagal diubah. Pesan error : '.$this->db->_error_message());
					redirect('useraccess');
				}			
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('useraccess');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function delete($username){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$where['USERNAME'] = $username;
		$res=$this->modelsip4->delete_data('sys_useraccess',$where);
		if($res>=1){
			$this->session->set_flashdata('successalert','Data '.$username.' berhasil dihapus');
			redirect('useraccess');
		}else{
			$this->session->set_flashdata('erroralert','Data '.$username.' gagal dihapus. Pesan error : '.$this->db->_error_message());
			redirect('useraccess');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}
}
