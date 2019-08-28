<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	var $nav;
	var $sl;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('USERNAME') ==''){
            redirect('login');
		}else{
			$return = $this->uauth->check_superadmin();
			$return2 = $this->uauth->check_admin();

			if(($return || $return2) == FALSE){
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

			$l = $this->session->userdata('LEVEL');
			if($l == "ADMINSD"){
				$this->sl = "SD";
			}
			if($l == "ADMINSMP"){
				$this->sl = "SMP";
			}
			if($l == "ADMINSMA"){
				$this->sl = "SMA";
			}
			if($l == "SUPERADMIN"){
				$this->sl = "%%";
			}
		}
	}
	public function index(){
		// $query = "select * from sys_article where STARTDATE <= NOW() and ENDDATE >= NOW() order by ARTICLEID ";
		$query = "select * from sys_article order by ARTICLEID ";
        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "procurement";
        $content['contentheader'] = "Pengumuman";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"article"),true);
        $content['contentheaderactive'] = "<li class='active'> Pengumuman</li>";
        $content['content'] = $this->load->view('article/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

	public function entryadd(){
		$article['TITLE'] = "";
		$article['ARTICLE'] = "";
		$article['STARTDATE'] = "";
		$article['ENDDATE'] = "";
		$data['data'] = $article;
        
        // $content['currentpage'] = "procurement";
        $content['contentheader'] = "Tambah Pengumuman";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"article"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Pengumuman</a></li><li class='active'> Tambah Pengumuman</li>";
        $content['content'] = $this->load->view('article/add',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function entryedit($articleid){
		$query = "select * from sys_article where ARTICLEID = '$articleid'";
		$result = $this->modelsip4->get_data($query);

		$article['ARTICLEID'] = $articleid;
		$article['TITLE'] = $result[0]['TITLE'];
		$article['ARTICLE'] = $result[0]['ARTICLE'];
		$article['STARTDATE'] = $result[0]['STARTDATE'];
		$article['ENDDATE'] = $result[0]['ENDDATE'];

		$data['data'] = $article;
        
        // $content['currentpage'] = "procurement";
        $content['contentheader'] = "Ubah Pengumuman";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"article"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Pengumuman</a></li><li class='active'> Ubah Pengumuman</li>";
        $content['content'] = $this->load->view('article/edit',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function add(){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_title','Judul','required');
		$this->form_validation->set_rules('txt_article','Pengumuman','required');
		$this->form_validation->set_rules('dtx_startdate','Tanggal Awal','required');
		$this->form_validation->set_rules('dtx_enddate','Tanggal Akhir','required');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$article['TITLE'] = $this->input->post('txt_title');
				$article['ARTICLE'] = $this->input->post('txt_article');
				$article['STARTDATE'] = $this->input->post('dtx_startdate');
				$article['ENDDATE'] = $this->input->post('dtx_enddate');
				$data['data'] = $article;

		        // $content['currentpage'] = "procurement";
		        $content['contentheader'] = "Tambah Pengumuman";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"article"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Pengumuman</a></li><li class='active'> Tambah Pengumuman</li>";
		        $content['content'] = $this->load->view('article/add',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['TITLE'] = $this->input->post('txt_title');
				$data['ARTICLE'] = $this->input->post('txt_article');
				$data['STARTDATE'] = $this->input->post('dtx_startdate');
				$data['ENDDATE'] = $this->input->post('dtx_enddate');

				$res=$this->modelsip4->add_data('sys_article',$data);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data berhasil ditambahkan');
					redirect('article');
				}else{
					$this->session->set_flashdata('erroralert','Data gagal ditambahkan. Pesan error : '.$this->db->_error_message());
					redirect('article');
				}
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('article');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function edit($articleid){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_title','Judul','required');
		$this->form_validation->set_rules('txt_article','Pengumuman','required');
		$this->form_validation->set_rules('dtx_startdate','Tanggal Awal','required');
		$this->form_validation->set_rules('dtx_enddate','Tanggal Akhir','required');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$article['TITLE'] = $this->input->post('txt_title');
				$article['ARTICLE'] = $this->input->post('txt_article');
				$article['STARTDATE'] = $this->input->post('dtx_startdate');
				$article['ENDDATE'] = $this->input->post('dtx_enddate');
				$data['data'] = $article;
		        
		        // $content['currentpage'] = "procurement";
		        $content['contentheader'] = "Ubah Pengumuman";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"article"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Pengumuman</a></li><li class='active'> Ubah Pengumuman</li>";
		        $content['content'] = $this->load->view('article/edit',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$data['TITLE'] = $this->input->post('txt_title');
				$data['ARTICLE'] = $this->input->post('txt_article');
				$data['STARTDATE'] = $this->input->post('dtx_startdate');
				$data['ENDDATE'] = $this->input->post('dtx_enddate');

				$where['ARTICLEID'] = $articleid;
				$res=$this->modelsip4->edit_data('sys_article',$data,$where);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data berhasil diubah');
					redirect('article');
				}else{
					$this->session->set_flashdata('erroralert','Data gagal diubah. Pesan error : '.$this->db->_error_message());
					redirect('article');
				}			
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('article');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function delete($articleid){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$where['ARTICLEID'] = $articleid;
		$res=$this->modelsip4->delete_data('sys_article',$where);
		if($res>=1){
			$this->session->set_flashdata('successalert','Data berhasil dihapus');
			redirect('article');
		}else{
			$this->session->set_flashdata('erroralert','Data gagal dihapus. Pesan error : '.$this->db->_error_message());
			redirect('article');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}
}
