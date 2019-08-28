<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $nav;

	public function __construct(){
		parent::__construct();
		// if($this->session->userdata('USERNAME') ==''):
  //           redirect('admin/clogin');
  //       endif;
  //       $this->load->model('admin/modeldak');

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

		$s = $this->session->userdata('SVCODE');
		if($s == "ADMIN"){
			$this->svc = "%%";
		}else{
			$this->svc = $s;
		}

		$l = $this->session->userdata('LEVEL');
		if($l == "ADMINSD"){
			$this->sl = "SD";
		}elseif($l == "ADMINSMP"){
			$this->sl = "SMP";
		}elseif($l == "ADMINSMA"){
			$this->sl = "SMA";
		}else{
			$this->sl = "%%";
		}
	}
	public function index(){
		// $npsn = $this->session->userdata('NPSN');
		// if ($npsn==null) {
		// 	$npsn="%";
		// }

		// $quer = "SELECT K.NPSN, S.NAMASEKOLAH ,K.TGL_CAIR,(SELECT COUNT(NAMAFOTO) FROM ref_foto WHERE PARENTID = K.`NPSN` AND KETERANGAN = '0') AS P0,(SELECT COUNT(NAMAFOTO) FROM ref_foto WHERE PARENTID = K.`NPSN` AND KETERANGAN = '30') AS P30,(SELECT COUNT(NAMAFOTO) FROM ref_foto WHERE PARENTID = K.`NPSN` AND KETERANGAN = '60') AS P60,(SELECT COUNT(NAMAFOTO) FROM ref_foto WHERE PARENTID = K.`NPSN` AND KETERANGAN = '80') AS P80,(SELECT COUNT(NAMAFOTO) FROM ref_foto WHERE PARENTID = K.`NPSN` AND KETERANGAN = '100') AS P100 FROM trx_kelayakan K LEFT JOIN ref_sekolah S ON S.NPSN = K.NPSN WHERE K.STATUSKELAYAKAN = 'LAYAK' AND K.NPSN LIKE '$npsn'";
		// $list = $this->modeldak->get_data($quer);

		// // if ($total_row > 0 ) {

		// // 	if ($list[0]['TGL_CAIR'] != "0000-00-00") {
				
		// // 				$today = date('Y-m-d');
		// // 				$tgl_cair = $list[0]['TGL_CAIR'];
		// // 				$diff = round(abs(strtotime($tgl_cair)-strtotime($today))/86400);
		// // 				if ($diff >= "21") {
		// // 					echo "belom ada progress";
		// // 				}

		// // 	}
			
		// // }

		// $content = array(
		// 	"contentheader"=>"Dashboard",
		// 	"navigation"=>$this->load->view('navigation/admin',array("currentpage"=>"dashboard"),true),
		// 	"contentheaderactive"=>"<li class='active'> Dashboard</li>",
		// 	"content"=>NULL,
		// 	);

		// $this->load->view('dashboard',$content);

		// $query = "select tpg.PROGRESSID as PROGRESSID, 
		// 	tpg.PROCNUMBER as PROCNUMBER, 
		// 	tp.PROCDESC as PROCDESC, 
		// 	rs.SUBDISTRICT as SUBDISTRICT,
		// 	tp.SCHOOLLEVEL as SCHOOLLEVEL,  
		// 	tpg.STEP as STEP, 
		// 	tp.ENDDATE as ENDDATE, 
		// 	rsv.SVNAME as SVNAME,
		// 	rpv.PVNAME as PVNAME,
		// 	tt.ALERTDATE as ALERTDATE,
  //           tt.DUEDATE as DUEDATE,
  //           tpg.CREATED as CREATED,
  //           if(tt.DUEDATE < NOW(), 'DANGER', 'WARNING') as STATUS
		// 	from trx_progress1 tpg 
		// 	left join trx_procurement tp on tp.PROCNUMBER = tpg.PROCNUMBER 
		// 	left join ref_subdistrict rs on rs.SUBDISTRICTID = tp.SUBDISTRICTID
		// 	left join ref_supervisor rsv on rsv.SVCODE = tp.SVCODE
		// 	left join ref_provider rpv on rpv.PVCODE = tp.PVCODE
		// 	left join trx_termin tt on tt.PROCNUMBER = tpg.PROCNUMBER
  //           						and tt.STEP = tpg.STEP
		// 	where tp.SVCODE like '$this->svc'
		// 	  and tp.SCHOOLLEVEL like '$this->sl'
		// 	  and tt.DUEDATE < NOW()
		// 	order by tpg.PROCNUMBER, tpg.STEP ";

		$query = "select  
				tt.PROCNUMBER as PROCNUMBER, 
				tp.PROCDESC as PROCDESC,  
				tp.SCHOOLLEVEL as SCHOOLLEVEL, 
				tt.STEP as STEP, 
				tp.SVCODE as SVCODE,
				rsv.SVNAME as SVNAME, 
				rsv.SVPHONENUMBER as SVPHONENUMBER,
				tt.ALERTDATE as ALERTDATE, 
				DATE_FORMAT(tt.DUEDATE,'%d-%m-%Y') as DUEDATE, 
				tpg.CREATED as CREATED, 
				if(tt.DUEDATE < NOW(), 'MELEBIHI BATAS TANGGAL PELAPORAN TEKNIS', '') as STATUS 
			from trx_termin tt 
			left join trx_progress1 tpg on tpg.PROCNUMBER = tt.PROCNUMBER 
									   and tpg.STEP = tt.STEP 
			left join trx_procurement tp on tp.PROCNUMBER = tt.PROCNUMBER  
			left join ref_supervisor rsv on rsv.SVCODE = tp.SVCODE 
			where tt.DUEDATE < NOW() 
			  and tpg.CREATED IS NULL  
			  and tp.SCHOOLLEVEL like '$this->sl' 
			  and tp.SVCODE like '$this->svc'  
			order by tt.PROCNUMBER, tt.STEP ";
        $data['list'] = $this->modelsip4->get_data($query);

		// $content['currentpage'] = "procurement";
		$content['contentheader'] = "Dashboard";
		$content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"dashboard"),true);
		$content['contentheaderactive'] = "<li class='active'> Dashboard</li>";
		$content['content'] = $this->load->view('main',$data,true);

		$this->load->view('dashboard',$content);
	}
}
