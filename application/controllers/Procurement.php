<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Procurement extends CI_Controller {

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
		$query = "select tp.PROCNUMBER as PROCNUMBER, 
			tp.PROCDESC as PROCDESC, 
			tp.SUBDISTRICTID as SUBDISTRICTID, 
			rs.SUBDISTRICT as SUBDISTRICT, 
			tp.SCHOOLLEVEL as SCHOOLLEVEL,
			tp.PVCODE as PVCODE, 
			rpv.PVNAME as PVNAME, 
			tp.CONTRACTVALUE as CONTRACTVALUE, 
			DATE_FORMAT(tp.CONTRACTDATE,'%d-%m-%Y') as CONTRACTDATE, 
			tp.SMPKDATE as SMPKDATE, 
			tp.NUMBEROFDAYS as NUMBEROFDAYS, 
			DATE_FORMAT(tp.ENDDATE,'%d-%m-%Y') as ENDDATE, 
			tp.SVCODE as SVCODE, 
			rsv.SVNAME as SVNAME, 
			tp.PROCTYPECODE as PROCTYPECODE, 
			rpt.PROCTYPEDESC as PROCTYPEDESC, 
			tp.CREATED as CREATED, 
			tp.UPDATED as UPDATED, 
			tp.USERLOG as USERLOG from trx_procurement tp 
			left join ref_subdistrict rs on rs.SUBDISTRICTID = tp.SUBDISTRICTID
			left join ref_provider rpv on rpv.PVCODE = tp.PVCODE
			left join ref_supervisor rsv on rsv.SVCODE = tp.SVCODE
			left join ref_procurementtype rpt on rpt.PROCTYPECODE = tp.PROCTYPECODE 
			where tp.SCHOOLLEVEL like '$this->sl'
			order by tp.PROCNUMBER ";
        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "procurement";
        $content['contentheader'] = "Data Kegiatan";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurement"),true);
        $content['contentheaderactive'] = "<li class='active'> Data Kegiatan</li>";
        $content['content'] = $this->load->view('procurement/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

    public function level($lev){
		$query = "select tp.PROCNUMBER as PROCNUMBER, 
			tp.PROCDESC as PROCDESC, 
			tp.SUBDISTRICTID as SUBDISTRICTID, 
			rs.SUBDISTRICT as SUBDISTRICT, 
			tp.SCHOOLLEVEL as SCHOOLLEVEL,
			tp.PVCODE as PVCODE, 
			rpv.PVNAME as PVNAME, 
			tp.CONTRACTVALUE as CONTRACTVALUE, 
			DATE_FORMAT(tp.CONTRACTDATE,'%d-%m-%Y') as CONTRACTDATE, 
			tp.SMPKDATE as SMPKDATE, 
			tp.NUMBEROFDAYS as NUMBEROFDAYS, 
			DATE_FORMAT(tp.ENDDATE,'%d-%m-%Y') as ENDDATE, 
			tp.SVCODE as SVCODE, 
			rsv.SVNAME as SVNAME, 
			tp.PROCTYPECODE as PROCTYPECODE, 
			rpt.PROCTYPEDESC as PROCTYPEDESC, 
			tp.CREATED as CREATED, 
			tp.UPDATED as UPDATED, 
			tp.USERLOG as USERLOG from trx_procurement tp 
			left join ref_subdistrict rs on rs.SUBDISTRICTID = tp.SUBDISTRICTID
			left join ref_provider rpv on rpv.PVCODE = tp.PVCODE
			left join ref_supervisor rsv on rsv.SVCODE = tp.SVCODE
			left join ref_procurementtype rpt on rpt.PROCTYPECODE = tp.PROCTYPECODE 
			where tp.SCHOOLLEVEL like '$lev'
			order by tp.PROCNUMBER ";
        $data['list'] = $this->modelsip4->get_data($query);
        
        // $content['currentpage'] = "procurement";
        $content['contentheader'] = "Data Kegiatan";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurement".$lev),true);
        $content['contentheaderactive'] = "<li><a href='#'> Data Kegiatan</a></li><li class='active'> ".$lev."</li>";
        $content['content'] = $this->load->view('procurement/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

	public function entryadd(){
		// $query = "select CONCAT('KP',LPAD(COALESCE((MAX(SUBSTRING(PROCNUMBER,3))+1), 1), 8, '0')) as PROCNUMBER from trx_procurement";
		// $result = $this->modelsip4->get_data($query);

		$schoollevel = "";
		$l = $this->session->userdata('LEVEL');
		if($l == "ADMINSD"){
			$schoollevel = "SD";
		}
		if($l == "ADMINSMP"){
			$schoollevel = "SMP";
		}
		if($l == "ADMINSMA"){
			$schoollevel = "SMA";
		}
		if($l == "SUPERADMIN"){
			$schoollevel = "";
		}

		$query2 = "select * from ref_subdistrict order by SUBDISTRICT";
		$result2 = $this->modelsip4->get_data($query2);

		$query3 = "select * from ref_provider order by PVNAME";
		$result3 = $this->modelsip4->get_data($query3);

		$query4 = "select * from ref_supervisor where SVCODE != 'ADMIN' order by SVNAME";
		$result4 = $this->modelsip4->get_data($query4);

		$query5 = "select * from ref_procurementtype order by PROCTYPEDESC";
		$result5 = $this->modelsip4->get_data($query5);

		// $procurement['PROCNUMBER'] = $result[0]['PROCNUMBER'];
		$procurement['PROCNUMBER'] = "";
		$procurement['PROCDESC'] = "";
		$procurement['SUBDISTRICTID'] = "";
		$procurement['SCHOOLLEVEL'] = $schoollevel;
		$procurement['PVCODE'] = "";
		$procurement['CONTRACTVALUE'] = "0";
		$procurement['CONTRACTDATE'] = "";
		$procurement['SMPKDATE'] = "";
		$procurement['NUMBEROFDAYS'] = "0";
		$procurement['ENDDATE'] = "";
		$procurement['SVCODE'] = "";
		$procurement['PROCTYPECODE'] = "";
		$procurement['PROCTYPEDESC'] = "";
		$procurement['subdistrictlist'] = $result2;
		$procurement['providerlist'] = $result3;
		$procurement['supervisorlist'] = $result4;
		$procurement['procurementtypelist'] = $result5;
		$data['data'] = $procurement;
        
        // $content['currentpage'] = "procurement";
        $content['contentheader'] = "Tambah Data Kegiatan";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurement"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Data Kegiatan</a></li><li class='active'> Tambah Data Kegiatan</li>";
        $content['content'] = $this->load->view('procurement/add',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function entryedit($procnumber){
		$query = "select * from trx_procurement where PROCNUMBER = '$procnumber'";
		$result = $this->modelsip4->get_data($query);

		$query2 = "select * from ref_subdistrict order by SUBDISTRICT";
		$result2 = $this->modelsip4->get_data($query2);

		$query3 = "select * from ref_provider order by PVNAME";
		$result3 = $this->modelsip4->get_data($query3);

		$query4 = "select * from ref_supervisor where SVCODE != 'ADMIN' order by SVNAME";
		$result4 = $this->modelsip4->get_data($query4);

		$query5 = "select * from ref_procurementtype order by PROCTYPEDESC";
		$result5 = $this->modelsip4->get_data($query5);

		$proctypedesc = "";
		if($result[0]['PROCTYPECODE'] == "PL01"){
			$proctypedesc = "PENGADAAN LANGSUNG";
		}else{
			$proctypedesc = "PENGADAAN LELANG";
		}

		$precontractdate = $result[0]['CONTRACTDATE'];
		$cd = explode('-' , $precontractdate);
		$contractdate = $cd[2]."-".$cd[1]."-".$cd[0];

		$preenddate = $result[0]['ENDDATE'];
		$ed = explode('-' , $preenddate);
		$enddate = $ed[2]."-".$ed[1]."-".$ed[0];

		$procurement['PROCNUMBER'] = $result[0]['PROCNUMBER'];
		$procurement['PROCDESC'] = $result[0]['PROCDESC'];
		$procurement['SUBDISTRICTID'] = $result[0]['SUBDISTRICTID'];
		$procurement['SCHOOLLEVEL'] = $result[0]['SCHOOLLEVEL'];
		$procurement['PVCODE'] = $result[0]['PVCODE'];
		$procurement['CONTRACTVALUE'] = $result[0]['CONTRACTVALUE'];
		$procurement['CONTRACTDATE'] = $contractdate;
		$procurement['SMPKDATE'] = $result[0]['SMPKDATE'];
		$procurement['NUMBEROFDAYS'] = $result[0]['NUMBEROFDAYS'];
		$procurement['ENDDATE'] = $enddate;
		$procurement['SVCODE'] = $result[0]['SVCODE'];
		$procurement['PROCTYPECODE'] = $result[0]['PROCTYPECODE'];
		$procurement['PROCTYPEDESC'] = $proctypedesc;
		$procurement['subdistrictlist'] = $result2;
		$procurement['providerlist'] = $result3;
		$procurement['supervisorlist'] = $result4;
		$procurement['procurementtypelist'] = $result5;
		$data['data'] = $procurement;
        
        // $content['currentpage'] = "procurement";
        $content['contentheader'] = "Ubah Data Kegiatan";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurement"),true);
        $content['contentheaderactive'] = "<li><a href='#'> Data Kegiatan</a></li><li class='active'> Ubah Data Kegiatan</li>";
        $content['content'] = $this->load->view('procurement/edit',$data,true);

		$this->load->view('dashboard',$content);
	}

	public function add(){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_procnumber','ID Kegiatan','required|is_unique[trx_procurement.PROCNUMBER]');
		$this->form_validation->set_rules('txt_procdesc','Nama Kegiatan','required');
		$this->form_validation->set_rules('cmb_subdistrict','Kecamatan','required');
		$this->form_validation->set_rules('cmb_schoollevel','Level Sekolah','required');
		$this->form_validation->set_rules('cmb_pv','Penyedia Jasa','required');
		$this->form_validation->set_rules('txt_contractvalue','Nilai Kontrak','required');
		$this->form_validation->set_rules('dtx_contractdate','Tanggal Kontrak','required');
		// $this->form_validation->set_rules('dtx_smpkdate','Tanggal SMPK','required');
		$this->form_validation->set_rules('txt_numberofdays','Waktu Pelaksanaan','required');
		$this->form_validation->set_rules('dtx_enddate','Tanggal Selesai','required');
		$this->form_validation->set_rules('cmb_sv','Konsultan Pengawas','required');
		$this->form_validation->set_rules('cmb_proctype','Jenis Kegiatan','required');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$query2 = "select * from ref_subdistrict order by SUBDISTRICT";
				$result2 = $this->modelsip4->get_data($query2);

				$query3 = "select * from ref_provider order by PVNAME";
				$result3 = $this->modelsip4->get_data($query3);

				$query4 = "select * from ref_supervisor order by SVNAME";
				$result4 = $this->modelsip4->get_data($query4);

				$query5 = "select * from ref_procurementtype order by PROCTYPEDESC";
				$result5 = $this->modelsip4->get_data($query5);

				$procurement['PROCNUMBER'] = $this->input->post('txt_procnumber');
				$procurement['PROCDESC'] = $this->input->post('txt_procdesc');
				$procurement['SUBDISTRICTID'] = $this->input->post('cmb_subdistrict');
				$procurement['SCHOOLLEVEL'] = $this->input->post('cmb_schoollevel');
				$procurement['PVCODE'] = $this->input->post('cmb_pv');
				$procurement['CONTRACTVALUE'] = $this->input->post('txt_contractvalue');
				$procurement['CONTRACTDATE'] = $this->input->post('dtx_contractdate');
				// $procurement['SMPKDATE'] = $this->input->post('dtx_smpkdate');
				$procurement['NUMBEROFDAYS'] = $this->input->post('txt_numberofdays');
				$procurement['ENDDATE'] = $this->input->post('dtx_enddate');
				$procurement['SVCODE'] = $this->input->post('cmb_sv');
				$procurement['PROCTYPECODE'] = $this->input->post('cmb_proctype');
				$procurement['PROCTYPEDESC'] = $this->input->post('txt_proctype');
				$procurement['subdistrictlist'] = $result2;
				$procurement['providerlist'] = $result3;
				$procurement['supervisorlist'] = $result4;
				$procurement['procurementtypelist'] = $result5;
				$data['data'] = $procurement;

		        // $content['currentpage'] = "procurement";
		        $content['contentheader'] = "Tambah Data Kegiatan";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurement"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Data Kegiatan</a></li><li class='active'> Tambah Data Kegiatan</li>";
		        $content['content'] = $this->load->view('procurement/add',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$numberofdays = $this->input->post('txt_numberofdays');
				$proctype = strtoupper($this->input->post('cmb_proctype'));
				$contractvalue = $this->input->post('txt_contractvalue');

				$precontractdate = $this->input->post('dtx_contractdate');
				$cd = explode('-' , $precontractdate);
				$contractdate = $cd[2]."-".$cd[1]."-".$cd[0];

				$preenddate = $this->input->post('dtx_enddate');
				$ed = explode('-' , $preenddate);
				$enddate = $ed[2]."-".$ed[1]."-".$ed[0];

				$data['PROCNUMBER'] = strtoupper($this->input->post('txt_procnumber'));
				$data['PROCDESC'] = strtoupper($this->input->post('txt_procdesc'));
				$data['SUBDISTRICTID'] = $this->input->post('cmb_subdistrict');
				$data['SCHOOLLEVEL'] = $this->input->post('cmb_schoollevel');
				$data['PVCODE'] = strtoupper($this->input->post('cmb_pv'));
				$data['CONTRACTVALUE'] = $contractvalue;
				$data['CONTRACTDATE'] = $contractdate;
				// $data['SMPKDATE'] = $this->input->post('dtx_smpkdate');
				$data['NUMBEROFDAYS'] = $numberofdays;
				$data['ENDDATE'] = $enddate;
				$data['SVCODE'] = strtoupper($this->input->post('cmb_sv'));
				$data['PROCTYPECODE'] = $proctype;

				$realnod = $numberofdays-7;
				$p3dvalue = round((1/$realnod)*100,2);
				$precprogperday = $p3dvalue."%";
				$data['PRECPROGPERDAY'] = $precprogperday;

				// $res=$this->modelsip4->add_data('trx_procurement',$data);
				// if($res>=1){
				// 	$this->session->set_flashdata('successalert','Data '.strtoupper($this->input->post('txt_procnumber')).' berhasil ditambahkan');
				// 	redirect('procurement/entryadd');
				// }else{
				// 	$this->session->set_flashdata('erroralert','Data '.strtoupper($this->input->post('txt_procnumber')).' gagal ditambahkan. Pesan error : '.$this->db->_error_message());
				// 	redirect('procurement/entryadd');
				// }

				//$cvperday = $contractvalue/$numberofdays;
				// $iscv = 0;

				$step = array();
				$indexday = array();
				$alertdate = array();
				$duedate = array();

				if($proctype == "PL01"){
					$steplength =  array((55/100),(100/100));
					$terminvalue =  array((50/100),(50/100));
					for($i = 0; $i < count($steplength); $i++){ 
						$step[] = $i+1;

						$iday = round(($steplength[$i]*$realnod),0)+7;
						$indexday[] = $iday;
						
						$alertdate[] = date('Y-m-d', strtotime($contractdate. ' + '.(($iday-3)-1).' days'));
						
						$duedate[] = date('Y-m-d', strtotime($contractdate. ' + '.($iday-1).' days'));
						
						// if($iscv < 1){
						// 	// $scv = round($cvperday*$iday,0);
						// 	$scv = $contractvalue*$steplength[$i];
						// }else{
						// 	// $iday2 = (round(($steplength[$i]*$realnod),0)+7)-(round(($steplength[$i-1]*$realnod),0)+7);
						// 	// $scv = round($cvperday*$iday2,0);
						// 	$scv = ($contractvalue*$steplength[$i])-($contractvalue*$steplength[$i-1]);
						// }
						$scv = $contractvalue*$terminvalue[$i];
						$subcontractvalue[] = $scv;

						// $iscv++;
					}
				}else{
					$steplength =  array((30/100),(60/100),(80/100),(100/100));
					$terminvalue =  array((25/100),(30/100),(20/100),(25/100));
					for($i = 0; $i < count($steplength); $i++){ 
						$step[] = $i+1;

						$iday = round(($steplength[$i]*$realnod),0)+7;
						$indexday[] = $iday;
						
						$alertdate[] = date('Y-m-d', strtotime($contractdate. ' + '.(($iday-3)-1).' days'));
						
						$duedate[] = date('Y-m-d', strtotime($contractdate. ' + '.($iday-1).' days'));
						
						// if($iscv < 1){
						// 	// $scv = round($cvperday*$iday,0);
						// 	$scv = $contractvalue*$steplength[$i];
						// }else{
						// 	// $iday2 = (round(($steplength[$i]*$realnod),0)+7)-(round(($steplength[$i-1]*$realnod),0)+7);
						// 	// $scv = round($cvperday*$iday2,0);
						// 	$scv = ($contractvalue*$steplength[$i])-($contractvalue*$steplength[$i-1]);
						// }
						$scv = $contractvalue*$terminvalue[$i];
						$subcontractvalue[] = $scv;

						//$iscv++;
					}
				}

				$data2['PROCNUMBER'] = strtoupper($this->input->post('txt_procnumber'));
				$data2['STEP'] = $step;
				$data2['INDEXDAY'] = $indexday;
				$data2['ALERTDATE'] = $alertdate;
				$data2['DUEDATE'] = $duedate;
				$data2['SUBCONTRACTVALUE'] = $subcontractvalue;	

		// // 		// $test = array((30/100),(60/100),(80/100),(100/100));
		// echo "<pre>";
		// 		// print_r(round(10.1,0));
		// // print_r(count($test));
		// print_r($data);
		// print_r($data2);
		// 		echo "</pre>";
		// 		die();

				$res=$this->modelsip4->add_trx_procurement('trx_procurement','trx_termin',$data,$data2);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data '.strtoupper($this->input->post('txt_procnumber')).' berhasil ditambahkan');
					redirect('procurement/entryadd');
				}else{
					$this->session->set_flashdata('erroralert','Data '.strtoupper($this->input->post('txt_procnumber')).' gagal ditambahkan. Pesan error : '.$this->db->_error_message());
					redirect('procurement/entryadd');
				}
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('procurement');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function edit($procnumber){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_procnumber','ID Kegiatan','required');
		$this->form_validation->set_rules('txt_procdesc','Nama Kegiatan','required');
		$this->form_validation->set_rules('cmb_subdistrict','Kecamatan','required');
		$this->form_validation->set_rules('cmb_schoollevel','Level Sekolah','required');
		$this->form_validation->set_rules('cmb_pv','Penyedia Jasa','required');
		$this->form_validation->set_rules('txt_contractvalue','Nilai Kontrak','required');
		$this->form_validation->set_rules('dtx_contractdate','Tanggal Kontrak','required');
		// $this->form_validation->set_rules('dtx_smpkdate','Tanggal SMPK','required');
		$this->form_validation->set_rules('txt_numberofdays','Waktu Pelaksanaan','required');
		$this->form_validation->set_rules('dtx_enddate','Tanggal Selesai','required');
		$this->form_validation->set_rules('cmb_sv','Konsultan Pengawas','required');
		$this->form_validation->set_rules('cmb_proctype','Jenis Kegiatan','required');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				$query2 = "select * from ref_subdistrict order by SUBDISTRICT";
				$result2 = $this->modelsip4->get_data($query2);

				$query3 = "select * from ref_provider order by PVNAME";
				$result3 = $this->modelsip4->get_data($query3);

				$query4 = "select * from ref_supervisor order by SVNAME";
				$result4 = $this->modelsip4->get_data($query4);

				$query5 = "select * from ref_procurementtype order by PROCTYPEDESC";
				$result5 = $this->modelsip4->get_data($query5);

				$procurement['PROCNUMBER'] = $this->input->post('txt_procnumber');
				$procurement['PROCDESC'] = $this->input->post('txt_procdesc');
				$procurement['SUBDISTRICTID'] = $this->input->post('cmb_subdistrict');
				$procurement['SCHOOLLEVEL'] = $this->input->post('cmb_schoollevel');
				$procurement['PVCODE'] = $this->input->post('cmb_pv');
				$procurement['CONTRACTVALUE'] = $this->input->post('txt_contractvalue');
				$procurement['CONTRACTDATE'] = $this->input->post('dtx_contractdate');
				// $procurement['SMPKDATE'] = $this->input->post('dtx_smpkdate');
				$procurement['NUMBEROFDAYS'] = $this->input->post('txt_numberofdays');
				$procurement['ENDDATE'] = $this->input->post('dtx_enddate');
				$procurement['SVCODE'] = $this->input->post('cmb_sv');
				$procurement['PROCTYPECODE'] = $this->input->post('cmb_proctype');
				$procurement['PROCTYPEDESC'] = $this->input->post('txt_proctype');
				$procurement['subdistrictlist'] = $result2;
				$procurement['providerlist'] = $result3;
				$procurement['supervisorlist'] = $result4;
				$procurement['procurementtypelist'] = $result5;
				$data['data'] = $procurement;
		        
		        // $content['currentpage'] = "procurement";
		        $content['contentheader'] = "Ubah Data Kegiatan";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"procurement"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Data Kegiatan</a></li><li class='active'> Ubah Data Kegiatan</li>";
		        $content['content'] = $this->load->view('procurement/edit',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$numberofdays = $this->input->post('txt_numberofdays');
				$proctype = strtoupper($this->input->post('cmb_proctype'));
				$contractvalue = $this->input->post('txt_contractvalue');

				$precontractdate = $this->input->post('dtx_contractdate');
				$cd = explode('-' , $precontractdate);
				$contractdate = $cd[2]."-".$cd[1]."-".$cd[0];

				$preenddate = $this->input->post('dtx_enddate');
				$ed = explode('-' , $preenddate);
				$enddate = $ed[2]."-".$ed[1]."-".$ed[0];

				$data['PROCDESC'] = strtoupper($this->input->post('txt_procdesc'));
				$data['SUBDISTRICTID'] = $this->input->post('cmb_subdistrict');
				$data['SCHOOLLEVEL'] = $this->input->post('cmb_schoollevel');
				$data['PVCODE'] = strtoupper($this->input->post('cmb_pv'));
				$data['CONTRACTVALUE'] = $contractvalue;
				$data['CONTRACTDATE'] = $contractdate;
				// $data['SMPKDATE'] = $this->input->post('dtx_smpkdate');
				$data['NUMBEROFDAYS'] = $numberofdays;
				$data['ENDDATE'] = $enddate;
				$data['SVCODE'] = strtoupper($this->input->post('cmb_sv'));
				$data['PROCTYPECODE'] = $proctype;

				$realnod = $numberofdays-7;
				$p3dvalue = round((1/$realnod)*100,2);
				$precprogperday = $p3dvalue."%";
				$data['PRECPROGPERDAY'] = $precprogperday;

				$cvperday = $contractvalue/$numberofdays;
				$iscv = 0;

				$step = array();
				$indexday = array();
				$alertdate = array();
				$duedate = array();

				if($proctype == "PL01"){
					$steplength =  array((60/100),(100/100));
					for($i = 0; $i < count($steplength); $i++){ 
						$step[] = $i+1;

						$iday = round(($steplength[$i]*$realnod),0)+7;
						$indexday[] = $iday;
						
						$alertdate[] = date('Y-m-d', strtotime($contractdate. ' + '.(($iday-3)-1).' days'));
						
						$duedate[] = date('Y-m-d', strtotime($contractdate. ' + '.($iday-1).' days'));
						
						if($iscv < 1){
							// $scv = round($cvperday*$iday,0);
							$scv = $contractvalue*$steplength[$i];
						}else{
							// $iday2 = (round(($steplength[$i]*$realnod),0)+7)-(round(($steplength[$i-1]*$realnod),0)+7);
							// $scv = round($cvperday*$iday2,0);
							$scv = ($contractvalue*$steplength[$i])-($contractvalue*$steplength[$i-1]);
						}
						$subcontractvalue[] = $scv;

						$iscv++;
					}
				}else{
					$steplength =  array((30/100),(60/100),(80/100),(100/100));
					for($i = 0; $i < count($steplength); $i++){ 
						$step[] = $i+1;

						$iday = round(($steplength[$i]*$realnod),0)+7;
						$indexday[] = $iday;
						
						$alertdate[] = date('Y-m-d', strtotime($contractdate. ' + '.(($iday-3)-1).' days'));
						
						$duedate[] = date('Y-m-d', strtotime($contractdate. ' + '.($iday-1).' days'));
						
						if($iscv < 1){
							// $scv = round($cvperday*$iday,0);
							$scv = $contractvalue*$steplength[$i];
						}else{
							// $iday2 = (round(($steplength[$i]*$realnod),0)+7)-(round(($steplength[$i-1]*$realnod),0)+7);
							// $scv = round($cvperday*$iday2,0);
							$scv = ($contractvalue*$steplength[$i])-($contractvalue*$steplength[$i-1]);
						}
						$subcontractvalue[] = $scv;

						$iscv++;
					}
				}

				$data2['PROCNUMBER'] = strtoupper($this->input->post('txt_procnumber'));
				$data2['STEP'] = $step;
				$data2['INDEXDAY'] = $indexday;
				$data2['ALERTDATE'] = $alertdate;
				$data2['DUEDATE'] = $duedate;
				$data2['SUBCONTRACTVALUE'] = $subcontractvalue;	

				$where['PROCNUMBER'] = $procnumber;
				$res=$this->modelsip4->edit_trx_procurement('trx_procurement','trx_termin',$data,$data2,$where);
				if($res>=1){
					$this->session->set_flashdata('successalert','Data kegiatan dengan ID '.$procnumber.' berhasil diubah');
					redirect('procurement');
				}else{
					$this->session->set_flashdata('erroralert','Data kegiatan dengan ID '.$procnumber.' gagal diubah. Pesan error : '.$this->db->_error_message());
					redirect('procurement');
				}			
			}
		}
		if($this->input->post('btn_cancel')){
			redirect('procurement');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function delete($procnumber){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$where['PROCNUMBER'] = $procnumber;
		$res=$this->modelsip4->delete_trx_procurement('trx_procurement','trx_termin',$where);
		if($res>=1){
			$this->session->set_flashdata('successalert','Data kegiatan dengan ID '.$procnumber.' berhasil dihapus');
			redirect('procurement');
		}else{
			$this->session->set_flashdata('erroralert','Data kegiatan dengan ID '.$procnumber.' gagal dihapus. Pesan error : '.$this->db->_error_message());
			redirect('procurement');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}
}
