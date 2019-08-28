<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('modellogin');
		$this->load->model('modelsip4');
	}
	public function index(){
                //print phpinfo();
		//die();
		if($this->session->userdata('USERNAME') == ''){
			$res = "";
        	$query = "select * from sys_article where STARTDATE <= NOW() and ENDDATE >= NOW() order by ARTICLEID ";
			$result = $this->modelsip4->get_data($query);

			if(count($result)<1){
				$res = NULL;
			}else{
				$res = $result;
			}				

			$login['list'] = $res;
			$login['USERNAME'] = "";
			$login['PASSWORD'] = "";
			$data['data'] = $login;
			
			$this->load->view('login',$data);
		}else{
			$content = array(
				"currentpage"=>"dashboard",
				"contentheader"=>"Dashboard",
				"contentheaderactive"=>"<li class='active'> Dashboard</li>",
				"content"=>NULL,
				);
			$this->load->view('dashboard',$content);
			redirect('dashboard');
		}
	}

	public function login()
	{
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_username','Username','required');
		$this->form_validation->set_rules('txt_password','Password','required');

		// print_r($_POST);
		// die();

		if($this->input->post('btn_login')){
			if($this->form_validation->run()==FALSE){
				$login['USERNAME'] = $this->input->post('txt_username');
				$login['PASSWORD'] = $this->input->post('txt_password');
				$data['data'] = $login;

		        $this->load->view('login',$data);
			}else{
				$this->load->library('cipher');
				$cipher = new Cipher(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
				 
				$key = "1qaz2WSX#edc";

				$user = $this->input->post('txt_username');
				$pass = $cipher->encrypt($this->input->post('txt_password'), $key);

				$cek = $this->modellogin->usercheck($user, $pass);
				
				if($cek == true){
					$content = array(
						"currentpage"=>"dashboard",
						"contentheader"=>"Dashboard",
						"contentheaderactive"=>"<li class='active'> Dashboard</li>",
						"content"=>NULL,
						);
					$this->load->view('dashboard',$content);
					redirect('dashboard');
				}else{
					$this->session->set_flashdata('erroralert','Login unsuccessful.');
					redirect('login');
				}		
			}
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function logout($username)
	{
        $data['STATUS'] = 0;
		$where['USERNAME'] = $username;
		$res=$this->modelsip4->edit_data('sys_useraccess',$data,$where);
		if($res>=1){
			$this->session->sess_destroy();
			redirect('login');
		}else{
			$this->session->set_flashdata('erroralert','Logout bermasalah. Pesan error : '.$this->db->_error_message());
			redirect('login');
		}
	}
}
