<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	var $nav;
	var $sl;
	var $svc;

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

			$s = $this->session->userdata('SVCODE');
			if($s == "ADMIN"){
				$this->svc = "%%";
			}else{
				$this->svc = $s;
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
		$query = "select tpg.PROGRESSID as PROGRESSID, 
			tpg.PROCNUMBER as PROCNUMBER, 
			tp.PROCDESC as PROCDESC, 
			rs.SUBDISTRICT as SUBDISTRICT,
			DATE_FORMAT(tp.CONTRACTDATE,'%d-%m-%Y') as CONTRACTDATE, 
			tp.NUMBEROFDAYS as NUMBEROFDAYS, 
                        DATE_FORMAT(tp.ENDDATE,'%d-%m-%Y') as ENDDATE,   
			tpg.STEP as STEP,
			tpg.TOTAL as TOTAL,
			rsv.SVNAME as SVNAME,
			rpv.PVNAME as PVNAME,
                        tp.SCHOOLLEVEL as SCHOOLLEVEL,
                        tt.SUBCONTRACTVALUE as SUBCONTRACTVALUE,
                        tp.CONTRACTVALUE as CONTRACTVALUE 
			from trx_progress1 tpg 
			left join trx_procurement tp on tp.PROCNUMBER = tpg.PROCNUMBER 
			left join ref_subdistrict rs on rs.SUBDISTRICTID = tp.SUBDISTRICTID
			left join ref_supervisor rsv on rsv.SVCODE = tp.SVCODE
			left join ref_provider rpv on rpv.PVCODE = tp.PVCODE
			left join trx_termin tt on tt.PROCNUMBER = tpg.PROCNUMBER
            						and tt.STEP = tpg.STEP
			where tp.SVCODE like '$this->svc'
			  and tp.SCHOOLLEVEL like '$this->sl'
			and tpg.STEP = (select max(tpg2.STEP) from trx_progress1 tpg2 where tpg2.PROCNUMBER = tpg.PROCNUMBER)
			order by tpg.PROCNUMBER, tpg.STEP ";

        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "procurement";
        $content['contentheader'] = "Report Progress";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"report"),true);
        $content['contentheaderactive'] = "<li class='active'> Report Progress</li>";
        $content['content'] = $this->load->view('reportprogress/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

	public function level($lev){
		$query = "select tpg.PROGRESSID as PROGRESSID, 
			tpg.PROCNUMBER as PROCNUMBER, 
			tp.PROCDESC as PROCDESC, 
			rs.SUBDISTRICT as SUBDISTRICT,
			DATE_FORMAT(tp.CONTRACTDATE,'%d-%m-%Y') as CONTRACTDATE, 
			tp.NUMBEROFDAYS as NUMBEROFDAYS, 
                        DATE_FORMAT(tp.ENDDATE,'%d-%m-%Y') as ENDDATE,  
			tpg.STEP as STEP,
			tpg.TOTAL as TOTAL,
			rsv.SVNAME as SVNAME,
			rpv.PVNAME as PVNAME,
                        tp.SCHOOLLEVEL as SCHOOLLEVEL,
                        tt.SUBCONTRACTVALUE as SUBCONTRACTVALUE,
                        tp.CONTRACTVALUE as CONTRACTVALUE
			from trx_progress1 tpg 
			left join trx_procurement tp on tp.PROCNUMBER = tpg.PROCNUMBER 
			left join ref_subdistrict rs on rs.SUBDISTRICTID = tp.SUBDISTRICTID
			left join ref_supervisor rsv on rsv.SVCODE = tp.SVCODE
			left join ref_provider rpv on rpv.PVCODE = tp.PVCODE
			left join trx_termin tt on tt.PROCNUMBER = tpg.PROCNUMBER
            						and tt.STEP = tpg.STEP
			where tp.SVCODE like '$this->svc'
			  and tp.SCHOOLLEVEL like '$lev'
			and tpg.STEP = (select max(tpg2.STEP) from trx_progress1 tpg2 where tpg2.PROCNUMBER = tpg.PROCNUMBER)
			order by tpg.PROCNUMBER, tpg.STEP ";

        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "procurement";
        $content['contentheader'] = "Report Progress Kegiatan Seksi ".$lev;
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"report".$lev),true);
        $content['contentheaderactive'] = "<li><a href='#'> Report Progress</a></li><li class='active'> ".$lev."</li>";
        $content['content'] = $this->load->view('reportprogress/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */