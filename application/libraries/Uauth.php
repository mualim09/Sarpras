<?php

/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

/**
* Description of General
*
* @author gieart
*/
class Uauth {

//put your code here
	var $ci;

	function __construct() {
		$this->ci = &get_instance();
	}

	function is_login() {
		if ($this->ci->session->userdata('is_login') == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function is_superadmin() {
		if ($this->ci->session->userdata('LEVEL') == 'SUPERADMIN') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function is_admin() {
		if ($this->ci->session->userdata('LEVEL') == 'ADMINSD' || $this->ci->session->userdata('LEVEL') == 'ADMINSMP' || $this->ci->session->userdata('LEVEL') == 'ADMINSMA') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function is_user() {
		if ($this->ci->session->userdata('LEVEL') == 'USER') {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function check_superadmin() {
		if (($this->is_login() && $this->is_superadmin()) != TRUE) {
			// $this->ci->session->set_flashdata('erroralert', 'Maaf, Anda tidak memiliki akses untuk halaman ini');
			// redirect('login');
			return FALSE;
		}else{
			return TRUE;
		}
	}

	function check_admin() {
		if (($this->is_login() && $this->is_admin()) != TRUE) {
			// $this->ci->session->set_flashdata('erroralert', 'Maaf, Anda tidak memiliki akses untuk halaman ini');
			// redirect('login');
			return FALSE;
		}else{
			return TRUE;
		}
	}

	function check_user() {
		if (($this->is_login() && $this->is_user()) != TRUE) {
			// $this->ci->session->set_flashdata('erroralert', 'Maaf, Anda tidak memiliki akses untuk halaman ini');
			// redirect('login');
			return FALSE;
		}else{
			return TRUE;
		}
	}
}

?>