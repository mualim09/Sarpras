<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress extends CI_Controller {

	var $nav;
	var $svc;
	var $sl;

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('USERNAME') ==''){
            redirect('login');
		}else{
			// $return = $this->uauth->check_admin();
			// $return2 = $this->uauth->check_user();

			// if(($return || $return2) == FALSE){
			// 	$this->session->set_flashdata('erroralert', 'Maaf, Anda tidak memiliki akses untuk halaman tersebut');
			// 	if($this->session->userdata('USERNAME') ==''){
		 //            redirect('login');
			// 	}else{
			// 		redirect('dashboard');
			// 	}
			// }
			
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
	}
	// start edit 12april2016
	public function index(){
   //      $query = "select tpg.PROGRESSID as PROGRESSID, 
			// tpg.PROCNUMBER as PROCNUMBER, 
			// tp.PROCDESC as PROCDESC,
			// tp.PROCTYPECODE as PROCTYPECODE, 
			// rpt.PROCTYPEDESC as PROCTYPEDESC,  
			// rs.SUBDISTRICT as SUBDISTRICT,
			// tp.SCHOOLLEVEL as SCHOOLLEVEL,  
			// tpg.STEP as STEP, 
			// tp.ENDDATE as ENDDATE, 
			// rsv.SVNAME as SVNAME,
			// rpv.PVNAME as PVNAME,
   //          tt.DUEDATE as DUEDATE,
   //          tpg.CREATED as CREATED
			// from trx_progress1 tpg 
			// left join trx_procurement tp on tp.PROCNUMBER = tpg.PROCNUMBER 
			// left join ref_procurementtype rpt on rpt.PROCTYPECODE = tp.PROCTYPECODE 
			// left join ref_subdistrict rs on rs.SUBDISTRICTID = tp.SUBDISTRICTID
			// left join ref_supervisor rsv on rsv.SVCODE = tp.SVCODE
			// left join ref_provider rpv on rpv.PVCODE = tp.PVCODE
			// left join trx_termin tt on tt.PROCNUMBER = tpg.PROCNUMBER
   //          						and tt.STEP = tpg.STEP
			// where tp.SVCODE like '$this->svc'
			//   and tp.SCHOOLLEVEL like '$this->sl'
			// order by tpg.PROCNUMBER, tpg.STEP ";

		$query = "select  
			tpg.PROCNUMBER as PROCNUMBER, 
			tp.PROCDESC as PROCDESC,
			tp.PROCTYPECODE as PROCTYPECODE, 
			rpt.PROCTYPEDESC as PROCTYPEDESC,  
			tp.SCHOOLLEVEL as SCHOOLLEVEL  
			
			from trx_progress1 tpg 
			left join trx_procurement tp on tp.PROCNUMBER = tpg.PROCNUMBER 
			left join ref_procurementtype rpt on rpt.PROCTYPECODE = tp.PROCTYPECODE 
            
			where tp.SVCODE like '$this->svc'
			  and tp.SCHOOLLEVEL like '$this->sl'
			group by
            	tpg.PROCNUMBER, 
				tp.PROCDESC,
				tp.PROCTYPECODE, 
				rpt.PROCTYPEDESC,  
				tp.SCHOOLLEVEL
            order by tpg.PROCNUMBER, tpg.STEP ";

        $data['list'] = $this->modelsip4->get_data($query);

        $query2 = "select 
			tpg.PROGRESSID as PROGRESSID, 
			tpg.PROCNUMBER as PROCNUMBER, 
			tp.PROCTYPECODE as PROCTYPECODE, 
			rpt.PROCTYPEDESC as PROCTYPEDESC,  
			tpg.STEP as STEP,
			tpg.TOTAL as TOTAL
			
			from trx_progress1 tpg 
			left join trx_procurement tp on tp.PROCNUMBER = tpg.PROCNUMBER 
			left join ref_procurementtype rpt on rpt.PROCTYPECODE = tp.PROCTYPECODE 
			
			where tp.SVCODE like '$this->svc'
			  and tp.SCHOOLLEVEL like '$this->sl'
			order by tpg.PROCNUMBER, tpg.STEP ";

        $data['list2'] = $this->modelsip4->get_data($query2);

        $query2 = "select * from ref_supervisor where SVCODE like '$this->svc' and SVCODE != 'ADMIN' order by SVNAME";
		$data['supervisorlist'] = $this->modelsip4->get_data($query2);

		$query3 = "select * from trx_procurement where SVCODE like '$this->svc' and SCHOOLLEVEL like '$this->sl' order by PROCNUMBER";
		$data['procurementlist'] = $this->modelsip4->get_data($query3);
        
        // $content['currentpage'] = "progress";
        $content['contentheader'] = "Data Progress";
        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"progress"),true);
        $content['contentheaderactive'] = "<li class='active'> Data Progress</li>";
        $content['content'] = $this->load->view('progress/index',$data,true);
		
		$this->load->view('dashboard',$content);
	}

	public function getprocurement(){
	     $svcode = $this->input->post('svcode');

	     if($svcode == ""){
	     	$svcode = "%%";
	     }
	     // $mapel = $this->mmapel->getMatapelajaran($kelas_id);
	     $query = "select * from trx_procurement where SVCODE like '$svcode' and SCHOOLLEVEL like '$this->sl' ";
		 $result = $this->modelsip4->get_data($query);
	     $data .= "<option value=''>--PILIH NAMA KEGIATAN--</option>";
	     foreach ($result as $res){
	          // $data .= "<option value='$mp[matapelajaran_id]'>$mp[matapelajaran_nama]</option>\n";
	          $data .= "<option value='$res[PROCNUMBER]'>$res[PROCDESC]</option>\n"; 
	     }
	     echo $data;
	  }

	public function entryadd(){
		// $query = "select CONCAT('KP',LPAD(COALESCE((MAX(SUBSTRING(PROCNUMBER,3))+1), 1), 8, '0')) as PROCNUMBER from trx_procurement";
		// $result = $this->modelsip4->get_data($query);

		$procnumber = $this->input->post('cmb_proc');

		$query2 = "select PROCDESC, PROCTYPECODE from trx_procurement where PROCNUMBER = '$procnumber' ";
		$result2 = $this->modelsip4->get_data($query2);
		
		$query3 = "select COALESCE(MAX(STEP)+1, 1) as STEP, 
			
			COALESCE(MAX(ATAPPENUTUP), 0.0) as ATAPPENUTUP, 
			COALESCE(MAX(ATAPRANGKA), 0.0) as ATAPRANGKA, 
			COALESCE(MAX(ATAPLIS), 0.0) as ATAPLIS, 
			COALESCE(MAX(PLAFONRANGKA), 0.0) as PLAFONRANGKA, 
			COALESCE(MAX(PLAFONPENUTUP), 0.0) as PLAFONPENUTUP, 
			COALESCE(MAX(PLAFONCAT), 0.0) as PLAFONCAT, 
			COALESCE(MAX(DINDINGKOLOM), 0.0) as DINDINGKOLOM, 
			COALESCE(MAX(DINDINGBATA), 0.0) as DINDINGBATA, 
			COALESCE(MAX(DINDINGCAT), 0.0) as DINDINGCAT, 
			COALESCE(MAX(PINTUJENDELAKUSEN), 0.0) as PINTUJENDELAKUSEN, 
			COALESCE(MAX(PINTUJENDELADAUNP), 0.0) as PINTUJENDELADAUNP, 
			COALESCE(MAX(PINTUJENDELADAUNJ), 0.0) as PINTUJENDELADAUNJ, 
			COALESCE(MAX(LANTAISTRUKTUR), 0.0) as LANTAISTRUKTUR, 
			COALESCE(MAX(LANTAIPENUTUP), 0.0) as LANTAIPENUTUP, 
			COALESCE(MAX(PONDASI), 0.0) as PONDASI, 
			COALESCE(MAX(PONDASISLOOF), 0.0) as PONDASISLOOF, 
			COALESCE(MAX(UTILITASLISTRIK), 0.0) as UTILITASLISTRIK, 
			COALESCE(MAX(UTILITASINSTALASIAIR), 0.0) as UTILITASINSTALASIAIR,

			COALESCE(MAX(RDOATAPPENUTUP), 0) as RDOATAPPENUTUP, 
			COALESCE(MAX(RDOATAPRANGKA), 0) as RDOATAPRANGKA, 
			COALESCE(MAX(RDOATAPLIS), 0) as RDOATAPLIS, 
			COALESCE(MAX(RDOPLAFONRANGKA), 0) as RDOPLAFONRANGKA, 
			COALESCE(MAX(RDOPLAFONPENUTUP), 0) as RDOPLAFONPENUTUP, 
			COALESCE(MAX(RDOPLAFONCAT), 0) as RDOPLAFONCAT, 
			COALESCE(MAX(RDODINDINGKOLOM), 0) as RDODINDINGKOLOM, 
			COALESCE(MAX(RDODINDINGBATA), 0) as RDODINDINGBATA, 
			COALESCE(MAX(RDODINDINGCAT), 0) as RDODINDINGCAT, 
			COALESCE(MAX(RDOPINTUJENDELAKUSEN), 0) as RDOPINTUJENDELAKUSEN, 
			COALESCE(MAX(RDOPINTUJENDELADAUNP), 0) as RDOPINTUJENDELADAUNP, 
			COALESCE(MAX(RDOPINTUJENDELADAUNJ), 0) as RDOPINTUJENDELADAUNJ, 
			COALESCE(MAX(RDOLANTAISTRUKTUR), 0) as RDOLANTAISTRUKTUR, 
			COALESCE(MAX(RDOLANTAIPENUTUP), 0) as RDOLANTAIPENUTUP, 
			COALESCE(MAX(RDOPONDASI), 0) as RDOPONDASI, 
			COALESCE(MAX(RDOPONDASISLOOF), 0) as RDOPONDASISLOOF, 
			COALESCE(MAX(RDOUTILITASLISTRIK), 0) as RDOUTILITASLISTRIK, 
			COALESCE(MAX(RDOUTILITASINSTALASIAIR), 0) as RDOUTILITASINSTALASIAIR, 
			
			COALESCE(MAX(TOTAL), 0.0) as TOTAL
			
			from trx_progress1 where PROCNUMBER = '$procnumber' ";

		$result3 = $this->modelsip4->get_data($query3);

		if(round($result3[0]['TOTAL'],2) < 100){
			$progress['PROCNUMBER'] = $procnumber;
			$progress['PROCDESC'] = $result2[0]['PROCDESC'];
			$progress['PROCTYPECODE'] = $result2[0]['PROCTYPECODE'];
			$progress['STEP'] = $result3[0]['STEP'];

			// $progress['ATAPPENUTUP'] = 0.0;
			// $progress['ATAPRANGKA'] = 0.0;
			// $progress['ATAPLIS'] = 0.0;
			// $progress['PLAFONRANGKA'] = 0.0;
			// $progress['PLAFONPENUTUP'] = 0.0;
			// $progress['PLAFONCAT'] = 0.0;
			// $progress['DINDINGKOLOM'] = 0.0;
			// $progress['DINDINGBATA'] = 0.0;
			// $progress['DINDINGCAT'] = 0.0;
			// $progress['PINTUJENDELAKUSEN'] = 0.0;
			// $progress['PINTUJENDELADAUNP'] = 0.0;
			// $progress['PINTUJENDELADAUNJ'] = 0.0;
			// $progress['LANTAISTRUKTUR'] = 0.0;
			// $progress['LANTAIPENUTUP'] = 0.0;
			// $progress['PONDASI'] = 0.0;
			// $progress['PONDASISLOOF'] = 0.0;
			// $progress['UTILITASLISTRIK'] = 0.0;
			// $progress['UTILITASINSTALASIAIR'] = 0.0;

			$progress['ATAPPENUTUP'] = round($result3[0]['ATAPPENUTUP'],2);
			$progress['ATAPRANGKA'] = round($result3[0]['ATAPRANGKA'],2);
			$progress['ATAPLIS'] = round($result3[0]['ATAPLIS'],2);
			$progress['PLAFONRANGKA'] = round($result3[0]['PLAFONRANGKA'],2);
			$progress['PLAFONPENUTUP'] = round($result3[0]['PLAFONPENUTUP'],2);
			$progress['PLAFONCAT'] = round($result3[0]['PLAFONCAT'],2);
			$progress['DINDINGKOLOM'] = round($result3[0]['DINDINGKOLOM'],2);
			$progress['DINDINGBATA'] = round($result3[0]['DINDINGBATA'],2);
			$progress['DINDINGCAT'] = round($result3[0]['DINDINGCAT'],2);
			$progress['PINTUJENDELAKUSEN'] = round($result3[0]['PINTUJENDELAKUSEN'],2);
			$progress['PINTUJENDELADAUNP'] = round($result3[0]['PINTUJENDELADAUNP'],2);
			$progress['PINTUJENDELADAUNJ'] = round($result3[0]['PINTUJENDELADAUNJ'],2);
			$progress['LANTAISTRUKTUR'] = round($result3[0]['LANTAISTRUKTUR'],2);
			$progress['LANTAIPENUTUP'] = round($result3[0]['LANTAIPENUTUP'],2);
			$progress['PONDASI'] = round($result3[0]['PONDASI'],2);
			$progress['PONDASISLOOF'] = round($result3[0]['PONDASISLOOF'],2);
			$progress['UTILITASLISTRIK'] = round($result3[0]['UTILITASLISTRIK'],2);
			$progress['UTILITASINSTALASIAIR'] = round($result3[0]['UTILITASINSTALASIAIR'],2);

			$progress['RDOATAPPENUTUP'] = $result3[0]['RDOATAPPENUTUP'];
			$progress['RDOATAPRANGKA'] = $result3[0]['RDOATAPRANGKA'];
			$progress['RDOATAPLIS'] = $result3[0]['RDOATAPLIS'];
			$progress['RDOPLAFONRANGKA'] = $result3[0]['RDOPLAFONRANGKA'];
			$progress['RDOPLAFONPENUTUP'] = $result3[0]['RDOPLAFONPENUTUP'];
			$progress['RDOPLAFONCAT'] = $result3[0]['RDOPLAFONCAT'];
			$progress['RDODINDINGKOLOM'] = $result3[0]['RDODINDINGKOLOM'];
			$progress['RDODINDINGBATA'] = $result3[0]['RDODINDINGBATA'];
			$progress['RDODINDINGCAT'] = $result3[0]['RDODINDINGCAT'];
			$progress['RDOPINTUJENDELAKUSEN'] = $result3[0]['RDOPINTUJENDELAKUSEN'];
			$progress['RDOPINTUJENDELADAUNP'] = $result3[0]['RDOPINTUJENDELADAUNP'];
			$progress['RDOPINTUJENDELADAUNJ'] = $result3[0]['RDOPINTUJENDELADAUNJ'];
			$progress['RDOLANTAISTRUKTUR'] = $result3[0]['RDOLANTAISTRUKTUR'];
			$progress['RDOLANTAIPENUTUP'] = $result3[0]['RDOLANTAIPENUTUP'];
			$progress['RDOPONDASI'] = $result3[0]['RDOPONDASI'];
			$progress['RDOPONDASISLOOF'] = $result3[0]['RDOPONDASISLOOF'];
			$progress['RDOUTILITASLISTRIK'] = $result3[0]['RDOUTILITASLISTRIK'];
			$progress['RDOUTILITASINSTALASIAIR'] = $result3[0]['RDOUTILITASINSTALASIAIR'];

			$progress2['RDOATAPPENUTUP'] = 0.0;
			$progress2['RDOATAPRANGKA'] = 0.0;
			$progress2['RDOATAPLIS'] = 0.0;
			$progress2['RDOPLAFONRANGKA'] = 0.0;
			$progress2['RDOPLAFONPENUTUP'] = 0.0;
			$progress2['RDOPLAFONCAT'] = 0.0;
			$progress2['RDODINDINGKOLOM'] = 0.0;
			$progress2['RDODINDINGBATA'] = 0.0;
			$progress2['RDODINDINGCAT'] = 0.0;
			$progress2['RDOPINTUJENDELAKUSEN'] = 0.0;
			$progress2['RDOPINTUJENDELADAUNP'] = 0.0;
			$progress2['RDOPINTUJENDELADAUNJ'] = 0.0;
			$progress2['RDOLANTAISTRUKTUR'] = 0.0;
			$progress2['RDOLANTAIPENUTUP'] = 0.0;
			$progress2['RDOPONDASI'] = 0.0;
			$progress2['RDOPONDASISLOOF'] = 0.0;
			$progress2['RDOUTILITASLISTRIK'] = 0.0;
			$progress2['RDOUTILITASINSTALASIAIR'] = 0.0;

			$progress['TOTAL'] = round($result3[0]['TOTAL'],2);
			$progress['VIDEO'] = "";
                        $progress['NOTE'] = "";
			// $progress['procurementlist'] = $result2;
			$data['data'] = $progress;
			$data['data2'] = $progress2;
	        
	        // $content['currentpage'] = "progress";
	        $content['contentheader'] = "Tambah Data Progress";
	        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"progress"),true);
	        $content['contentheaderactive'] = "<li><a href='#'> Data Progress</a></li><li class='active'> Tambah Data Progress</li>";
	        $content['content'] = $this->load->view('progress/add',$data,true);

			$this->load->view('dashboard',$content);
		}else{
			$this->session->set_flashdata('successalert','Progress kegiatan '.$result2[0]['PROCDESC'].' telah lengkap');
			redirect('progress');
		}
		
	}
	// end edit 12april2016

	public function add($procnumber){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$this->form_validation->set_rules('txt_procdesc','Nama Kegiatan','required');
		$this->form_validation->set_rules('txt_step','Step','required');
		$this->form_validation->set_rules('txt_atappenutup','Penutup Atap','required');
		$this->form_validation->set_rules('txt_ataprangka','Rangka Atap','required');
		$this->form_validation->set_rules('txt_ataplis','Lis Plang & Talang','required');
		$this->form_validation->set_rules('txt_plafonrangka','Rangka Plafon','required');
		$this->form_validation->set_rules('txt_plafonpenutup','Penutup & Lis Plafon','required');
		$this->form_validation->set_rules('txt_plafoncat','Cat','required');
		$this->form_validation->set_rules('txt_dindingkolom','Kolom & Balok Ring','required');
		$this->form_validation->set_rules('txt_dindingbata','Bata/Dinding Pengisi','required');
		$this->form_validation->set_rules('txt_dindingcat','Cat','required');
		$this->form_validation->set_rules('txt_pintujendelakusen','Kusen','required');
		$this->form_validation->set_rules('txt_pintujendeladaunp','Daun Pintu','required');
		$this->form_validation->set_rules('txt_pintujendeladaunj','Daun Jendela','required');
		$this->form_validation->set_rules('txt_lantaistruktur','Struktur Bawah','required');
		$this->form_validation->set_rules('txt_lantaipenutup','Penutup Lantai','required');
		$this->form_validation->set_rules('txt_pondasi','Pondasi','required');
		$this->form_validation->set_rules('txt_pondasisloof','Sloof','required');
		$this->form_validation->set_rules('txt_utilitaslistrik','Listrik','required');
		$this->form_validation->set_rules('txt_utilitasinstalasiair','Instalasi Air Hujan & Pasangan Rabat Beton Keliling Bangunan','required');
		$this->form_validation->set_rules('txt_total','Jumlah','required');
		// $this->form_validation->set_rules('txt_video','Video','required');
		if($this->input->post('btn_save')){
			if($this->form_validation->run()==FALSE){
				// $query2 = "select * from trx_procurement order by PROCNUMBER";
				// $result2 = $this->modelsip4->get_data($query2);

				$query3 = "select COALESCE(MAX(STEP)+1, 1) as STEP, 

					COALESCE(MAX(RDOATAPPENUTUP), 0) as RDOATAPPENUTUP, 
					COALESCE(MAX(RDOATAPRANGKA), 0) as RDOATAPRANGKA, 
					COALESCE(MAX(RDOATAPLIS), 0) as RDOATAPLIS, 
					COALESCE(MAX(RDOPLAFONRANGKA), 0) as RDOPLAFONRANGKA, 
					COALESCE(MAX(RDOPLAFONPENUTUP), 0) as RDOPLAFONPENUTUP, 
					COALESCE(MAX(RDOPLAFONCAT), 0) as RDOPLAFONCAT, 
					COALESCE(MAX(RDODINDINGKOLOM), 0) as RDODINDINGKOLOM, 
					COALESCE(MAX(RDODINDINGBATA), 0) as RDODINDINGBATA, 
					COALESCE(MAX(RDODINDINGCAT), 0) as RDODINDINGCAT, 
					COALESCE(MAX(RDOPINTUJENDELAKUSEN), 0) as RDOPINTUJENDELAKUSEN, 
					COALESCE(MAX(RDOPINTUJENDELADAUNP), 0) as RDOPINTUJENDELADAUNP, 
					COALESCE(MAX(RDOPINTUJENDELADAUNJ), 0) as RDOPINTUJENDELADAUNJ, 
					COALESCE(MAX(RDOLANTAISTRUKTUR), 0) as RDOLANTAISTRUKTUR, 
					COALESCE(MAX(RDOLANTAIPENUTUP), 0) as RDOLANTAIPENUTUP, 
					COALESCE(MAX(RDOPONDASI), 0) as RDOPONDASI, 
					COALESCE(MAX(RDOPONDASISLOOF), 0) as RDOPONDASISLOOF, 
					COALESCE(MAX(RDOUTILITASLISTRIK), 0) as RDOUTILITASLISTRIK, 
					COALESCE(MAX(RDOUTILITASINSTALASIAIR), 0) as RDOUTILITASINSTALASIAIR 
										
					from trx_progress1 where PROCNUMBER = '$procnumber' ";

				$result3 = $this->modelsip4->get_data($query3);

				$progress['PROCNUMBER'] = $procnumber;
				$progress['PROCTYPECODE'] = $this->input->post('cmb_proctype');
				$progress['PROCDESC'] = $this->input->post('txt_procdesc');
				$progress['STEP'] = $this->input->post('txt_step');

				$progress['ATAPPENUTUP'] = $this->input->post('txt_atappenutup');
				$progress['ATAPRANGKA'] = $this->input->post('txt_ataprangka');
				$progress['ATAPLIS'] = $this->input->post('txt_ataplis');
				$progress['PLAFONRANGKA'] = $this->input->post('txt_plafonrangka');
				$progress['PLAFONPENUTUP'] = $this->input->post('txt_plafonpenutup');
				$progress['PLAFONCAT'] = $this->input->post('txt_plafoncat');
				$progress['DINDINGKOLOM'] = $this->input->post('txt_dindingkolom');
				$progress['DINDINGBATA'] = $this->input->post('txt_dindingbata');
				$progress['DINDINGCAT'] = $this->input->post('txt_dindingcat');
				$progress['PINTUJENDELAKUSEN'] = $this->input->post('txt_pintujendelakusen');
				$progress['PINTUJENDELADAUNP'] = $this->input->post('txt_pintujendeladaunp');
				$progress['PINTUJENDELADAUNJ'] = $this->input->post('txt_pintujendeladaunj');
				$progress['LANTAISTRUKTUR'] = $this->input->post('txt_lantaistruktur');
				$progress['LANTAIPENUTUP'] = $this->input->post('txt_lantaipenutup');
				$progress['PONDASI'] = $this->input->post('txt_pondasi');
				$progress['PONDASISLOOF'] = $this->input->post('txt_pondasisloof');
				$progress['UTILITASLISTRIK'] = $this->input->post('txt_utilitaslistrik');
				$progress['UTILITASINSTALASIAIR'] = $this->input->post('txt_utilitasinstalasiair');

				$progress['RDOATAPPENUTUP'] = $result3[0]['RDOATAPPENUTUP'];
				$progress['RDOATAPRANGKA'] = $result3[0]['RDOATAPRANGKA'];
				$progress['RDOATAPLIS'] = $result3[0]['RDOATAPLIS'];
				$progress['RDOPLAFONRANGKA'] = $result3[0]['RDOPLAFONRANGKA'];
				$progress['RDOPLAFONPENUTUP'] = $result3[0]['RDOPLAFONPENUTUP'];
				$progress['RDOPLAFONCAT'] = $result3[0]['RDOPLAFONCAT'];
				$progress['RDODINDINGKOLOM'] = $result3[0]['RDODINDINGKOLOM'];
				$progress['RDODINDINGBATA'] = $result3[0]['RDODINDINGBATA'];
				$progress['RDODINDINGCAT'] = $result3[0]['RDODINDINGCAT'];
				$progress['RDOPINTUJENDELAKUSEN'] = $result3[0]['RDOPINTUJENDELAKUSEN'];
				$progress['RDOPINTUJENDELADAUNP'] = $result3[0]['RDOPINTUJENDELADAUNP'];
				$progress['RDOPINTUJENDELADAUNJ'] = $result3[0]['RDOPINTUJENDELADAUNJ'];
				$progress['RDOLANTAISTRUKTUR'] = $result3[0]['RDOLANTAISTRUKTUR'];
				$progress['RDOLANTAIPENUTUP'] = $result3[0]['RDOLANTAIPENUTUP'];
				$progress['RDOPONDASI'] = $result3[0]['RDOPONDASI'];
				$progress['RDOPONDASISLOOF'] = $result3[0]['RDOPONDASISLOOF'];
				$progress['RDOUTILITASLISTRIK'] = $result3[0]['RDOUTILITASLISTRIK'];
				$progress['RDOUTILITASINSTALASIAIR'] = $result3[0]['RDOUTILITASINSTALASIAIR'];

				$progress2['RDOATAPPENUTUP'] = $this->input->post('rdo_atappenutup');
				$progress2['RDOATAPRANGKA'] = $this->input->post('rdo_ataprangka');
				$progress2['RDOATAPLIS'] = $this->input->post('rdo_ataplis');
				$progress2['RDOPLAFONRANGKA'] = $this->input->post('rdo_plafonrangka');
				$progress2['RDOPLAFONPENUTUP'] = $this->input->post('rdo_plafonpenutup');
				$progress2['RDOPLAFONCAT'] = $this->input->post('rdo_plafoncat');
				$progress2['RDODINDINGKOLOM'] = $this->input->post('rdo_dindingkolom');
				$progress2['RDODINDINGBATA'] = $this->input->post('rdo_dindingbata');
				$progress2['RDODINDINGCAT'] = $this->input->post('rdo_dindingcat');
				$progress2['RDOPINTUJENDELAKUSEN'] = $this->input->post('rdo_pintujendelakusen');
				$progress2['RDOPINTUJENDELADAUNP'] = $this->input->post('rdo_pintujendeladaunp');
				$progress2['RDOPINTUJENDELADAUNJ'] = $this->input->post('rdo_pintujendeladaunj');
				$progress2['RDOLANTAISTRUKTUR'] = $this->input->post('rdo_lantaistruktur');
				$progress2['RDOLANTAIPENUTUP'] = $this->input->post('rdo_lantaipenutup');
				$progress2['RDOPONDASI'] = $this->input->post('rdo_pondasi');
				$progress2['RDOPONDASISLOOF'] = $this->input->post('rdo_pondasisloof');
				$progress2['RDOUTILITASLISTRIK'] = $this->input->post('rdo_utilitaslistrik');
				$progress2['RDOUTILITASINSTALASIAIR'] = $this->input->post('rdo_utilitasinstalasiair');

				$progress['TOTAL'] = $this->input->post('txt_total');
                                $progress['NOTE'] = $this->input->post('txt_note');
				// $progress['VIDEO'] = $this->input->post('txt_video');
				// $progress['procurementlist'] = $result2;
				$data['data'] = $progress;
				$data['data2'] = $progress2;

		        // $content['currentpage'] = "progress";
		        $content['contentheader'] = "Tambah Data Progress";
		        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"progress"),true);
		        $content['contentheaderactive'] = "<li><a href='#'> Data Progress</a></li><li class='active'> Tambah Data Progress</li>";
		        $content['content'] = $this->load->view('progress/add',$data,true);

				$this->load->view('dashboard',$content);
			}else{
				$videoname = $_FILES['txt_video']['name'];
	
				$prename = $procnumber . "_" . $this->input->post('txt_step');
				
				// Konfigurasi Upload Gambar
				
				$config['file_name'] = $prename.'_'.'_'.$videoname;
				$config['upload_path'] = './files/video';
				$config['allowed_types'] = 'mp4|flv|avi';
				$config['max_size']	= '256000';
				$config['max_width']  = '';
				$config['max_height']  = '';
				
				// End Konfigurasi Upload Gambar
				
				// Memuat Library Upload File
				$this->load->library('upload', $config);

				if (! $this->upload->do_upload("txt_video"))
				{
					// Jika Konfigurasi tidak cocok :
					$this->session->set_flashdata('erroralert','Video gagal diupload. Pesan error : '.$this->upload->display_errors());

					// $query2 = "select * from trx_procurement order by PROCNUMBER";
					// $result2 = $this->modelsip4->get_data($query2);

					$query3 = "select COALESCE(MAX(STEP)+1, 1) as STEP,

						COALESCE(MAX(RDOATAPPENUTUP), 0) as RDOATAPPENUTUP, 
						COALESCE(MAX(RDOATAPRANGKA), 0) as RDOATAPRANGKA, 
						COALESCE(MAX(RDOATAPLIS), 0) as RDOATAPLIS, 
						COALESCE(MAX(RDOPLAFONRANGKA), 0) as RDOPLAFONRANGKA, 
						COALESCE(MAX(RDOPLAFONPENUTUP), 0) as RDOPLAFONPENUTUP, 
						COALESCE(MAX(RDOPLAFONCAT), 0) as RDOPLAFONCAT, 
						COALESCE(MAX(RDODINDINGKOLOM), 0) as RDODINDINGKOLOM, 
						COALESCE(MAX(RDODINDINGBATA), 0) as RDODINDINGBATA, 
						COALESCE(MAX(RDODINDINGCAT), 0) as RDODINDINGCAT, 
						COALESCE(MAX(RDOPINTUJENDELAKUSEN), 0) as RDOPINTUJENDELAKUSEN, 
						COALESCE(MAX(RDOPINTUJENDELADAUNP), 0) as RDOPINTUJENDELADAUNP, 
						COALESCE(MAX(RDOPINTUJENDELADAUNJ), 0) as RDOPINTUJENDELADAUNJ, 
						COALESCE(MAX(RDOLANTAISTRUKTUR), 0) as RDOLANTAISTRUKTUR, 
						COALESCE(MAX(RDOLANTAIPENUTUP), 0) as RDOLANTAIPENUTUP, 
						COALESCE(MAX(RDOPONDASI), 0) as RDOPONDASI, 
						COALESCE(MAX(RDOPONDASISLOOF), 0) as RDOPONDASISLOOF, 
						COALESCE(MAX(RDOUTILITASLISTRIK), 0) as RDOUTILITASLISTRIK, 
						COALESCE(MAX(RDOUTILITASINSTALASIAIR), 0) as RDOUTILITASINSTALASIAIR 
						
						from trx_progress1 where PROCNUMBER = '$procnumber' ";

					$result3 = $this->modelsip4->get_data($query3);

					$progress['PROCNUMBER'] = $procnumber;
					$progress['PROCTYPECODE'] = $this->input->post('cmb_proctype');
					$progress['PROCDESC'] = $this->input->post('txt_procdesc');
					$progress['STEP'] = $this->input->post('txt_step');

					$progress['ATAPPENUTUP'] = $this->input->post('txt_atappenutup');
					$progress['ATAPRANGKA'] = $this->input->post('txt_ataprangka');
					$progress['ATAPLIS'] = $this->input->post('txt_ataplis');
					$progress['PLAFONRANGKA'] = $this->input->post('txt_plafonrangka');
					$progress['PLAFONPENUTUP'] = $this->input->post('txt_plafonpenutup');
					$progress['PLAFONCAT'] = $this->input->post('txt_plafoncat');
					$progress['DINDINGKOLOM'] = $this->input->post('txt_dindingkolom');
					$progress['DINDINGBATA'] = $this->input->post('txt_dindingbata');
					$progress['DINDINGCAT'] = $this->input->post('txt_dindingcat');
					$progress['PINTUJENDELAKUSEN'] = $this->input->post('txt_pintujendelakusen');
					$progress['PINTUJENDELADAUNP'] = $this->input->post('txt_pintujendeladaunp');
					$progress['PINTUJENDELADAUNJ'] = $this->input->post('txt_pintujendeladaunj');
					$progress['LANTAISTRUKTUR'] = $this->input->post('txt_lantaistruktur');
					$progress['LANTAIPENUTUP'] = $this->input->post('txt_lantaipenutup');
					$progress['PONDASI'] = $this->input->post('txt_pondasi');
					$progress['PONDASISLOOF'] = $this->input->post('txt_pondasisloof');
					$progress['UTILITASLISTRIK'] = $this->input->post('txt_utilitaslistrik');
					$progress['UTILITASINSTALASIAIR'] = $this->input->post('txt_utilitasinstalasiair');

					$progress['RDOATAPPENUTUP'] = $result3[0]['RDOATAPPENUTUP'];
					$progress['RDOATAPRANGKA'] = $result3[0]['RDOATAPRANGKA'];
					$progress['RDOATAPLIS'] = $result3[0]['RDOATAPLIS'];
					$progress['RDOPLAFONRANGKA'] = $result3[0]['RDOPLAFONRANGKA'];
					$progress['RDOPLAFONPENUTUP'] = $result3[0]['RDOPLAFONPENUTUP'];
					$progress['RDOPLAFONCAT'] = $result3[0]['RDOPLAFONCAT'];
					$progress['RDODINDINGKOLOM'] = $result3[0]['RDODINDINGKOLOM'];
					$progress['RDODINDINGBATA'] = $result3[0]['RDODINDINGBATA'];
					$progress['RDODINDINGCAT'] = $result3[0]['RDODINDINGCAT'];
					$progress['RDOPINTUJENDELAKUSEN'] = $result3[0]['RDOPINTUJENDELAKUSEN'];
					$progress['RDOPINTUJENDELADAUNP'] = $result3[0]['RDOPINTUJENDELADAUNP'];
					$progress['RDOPINTUJENDELADAUNJ'] = $result3[0]['RDOPINTUJENDELADAUNJ'];
					$progress['RDOLANTAISTRUKTUR'] = $result3[0]['RDOLANTAISTRUKTUR'];
					$progress['RDOLANTAIPENUTUP'] = $result3[0]['RDOLANTAIPENUTUP'];
					$progress['RDOPONDASI'] = $result3[0]['RDOPONDASI'];
					$progress['RDOPONDASISLOOF'] = $result3[0]['RDOPONDASISLOOF'];
					$progress['RDOUTILITASLISTRIK'] = $result3[0]['RDOUTILITASLISTRIK'];
					$progress['RDOUTILITASINSTALASIAIR'] = $result3[0]['RDOUTILITASINSTALASIAIR'];

					$progress2['RDOATAPPENUTUP'] = $this->input->post('rdo_atappenutup');
					$progress2['RDOATAPRANGKA'] = $this->input->post('rdo_ataprangka');
					$progress2['RDOATAPLIS'] = $this->input->post('rdo_ataplis');
					$progress2['RDOPLAFONRANGKA'] = $this->input->post('rdo_plafonrangka');
					$progress2['RDOPLAFONPENUTUP'] = $this->input->post('rdo_plafonpenutup');
					$progress2['RDOPLAFONCAT'] = $this->input->post('rdo_plafoncat');
					$progress2['RDODINDINGKOLOM'] = $this->input->post('rdo_dindingkolom');
					$progress2['RDODINDINGBATA'] = $this->input->post('rdo_dindingbata');
					$progress2['RDODINDINGCAT'] = $this->input->post('rdo_dindingcat');
					$progress2['RDOPINTUJENDELAKUSEN'] = $this->input->post('rdo_pintujendelakusen');
					$progress2['RDOPINTUJENDELADAUNP'] = $this->input->post('rdo_pintujendeladaunp');
					$progress2['RDOPINTUJENDELADAUNJ'] = $this->input->post('rdo_pintujendeladaunj');
					$progress2['RDOLANTAISTRUKTUR'] = $this->input->post('rdo_lantaistruktur');
					$progress2['RDOLANTAIPENUTUP'] = $this->input->post('rdo_lantaipenutup');
					$progress2['RDOPONDASI'] = $this->input->post('rdo_pondasi');
					$progress2['RDOPONDASISLOOF'] = $this->input->post('rdo_pondasisloof');
					$progress2['RDOUTILITASLISTRIK'] = $this->input->post('rdo_utilitaslistrik');
					$progress2['RDOUTILITASINSTALASIAIR'] = $this->input->post('rdo_utilitasinstalasiair');

					$progress['TOTAL'] = $this->input->post('txt_total');
                                        $progress['NOTE'] = $this->input->post('txt_note');
					// $progress['VIDEO'] = $this->input->post('txt_video');
					// $progress['procurementlist'] = $result2;
					$data['data'] = $progress;
					$data['data2'] = $progress2;

			        // $content['currentpage'] = "progress";
			        $content['contentheader'] = "Tambah Data Progress";
			        $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"progress"),true);
			        $content['contentheaderactive'] = "<li><a href='#'> Data Progress</a></li><li class='active'> Tambah Data Progress</li>";
			        $content['content'] = $this->load->view('progress/add',$data,true);

					$this->load->view('dashboard',$content);
				}
				else{
					//$uploaddata = array('upload_data' => $this->upload->data());
						
					$created = date('Y-m-d H:i:s');
					
					$getfiledata = $this->upload->data();
					$video = $getfiledata['file_name'];
					$filetype = $getfiledata['file_type'];

                   //exec("ffmpeg -i ".$getfiledata['full_path']." ".$getfiledata['file_path'].$getfiledata['raw_name'].".flv");

					$data['PROCNUMBER'] = $procnumber;
					$data['STEP'] = $this->input->post('txt_step');

					$data['ATAPPENUTUP'] = $this->input->post('txt_atappenutup');
					$data['ATAPRANGKA'] = $this->input->post('txt_ataprangka');
					$data['ATAPLIS'] = $this->input->post('txt_ataplis');
					$data['PLAFONRANGKA'] = $this->input->post('txt_plafonrangka');
					$data['PLAFONPENUTUP'] = $this->input->post('txt_plafonpenutup');
					$data['PLAFONCAT'] = $this->input->post('txt_plafoncat');
					$data['DINDINGKOLOM'] = $this->input->post('txt_dindingkolom');
					$data['DINDINGBATA'] = $this->input->post('txt_dindingbata');
					$data['DINDINGCAT'] = $this->input->post('txt_dindingcat');
					$data['PINTUJENDELAKUSEN'] = $this->input->post('txt_pintujendelakusen');
					$data['PINTUJENDELADAUNP'] = $this->input->post('txt_pintujendeladaunp');
					$data['PINTUJENDELADAUNJ'] = $this->input->post('txt_pintujendeladaunj');
					$data['LANTAISTRUKTUR'] = $this->input->post('txt_lantaistruktur');
					$data['LANTAIPENUTUP'] = $this->input->post('txt_lantaipenutup');
					$data['PONDASI'] = $this->input->post('txt_pondasi');
					$data['PONDASISLOOF'] = $this->input->post('txt_pondasisloof');
					$data['UTILITASLISTRIK'] = $this->input->post('txt_utilitaslistrik');
					$data['UTILITASINSTALASIAIR'] = $this->input->post('txt_utilitasinstalasiair');
					
					$rdo_atappenutup = $this->input->post('rdo_atappenutup') > 0 ? $this->input->post('rdo_atappenutup') : $this->input->post('lc_atappenutup');
					$rdo_ataprangka = $this->input->post('rdo_ataprangka') > 0 ? $this->input->post('rdo_ataprangka') : $this->input->post('lc_ataprangka');
					$rdo_ataplis = $this->input->post('rdo_ataplis') > 0 ? $this->input->post('rdo_ataplis') : $this->input->post('lc_ataplis');
					$rdo_plafonrangka = $this->input->post('rdo_plafonrangka') > 0 ? $this->input->post('rdo_plafonrangka') : $this->input->post('lc_plafonrangka');
					$rdo_plafonpenutup = $this->input->post('rdo_plafonpenutup') > 0 ? $this->input->post('rdo_plafonpenutup') : $this->input->post('lc_plafonpenutup');
					$rdo_plafoncat = $this->input->post('rdo_plafoncat') > 0 ? $this->input->post('rdo_plafoncat') : $this->input->post('lc_plafoncat');
					$rdo_dindingkolom = $this->input->post('rdo_dindingkolom') > 0 ? $this->input->post('rdo_dindingkolom') : $this->input->post('lc_dindingkolom');
					$rdo_dindingbata = $this->input->post('rdo_dindingbata') > 0 ? $this->input->post('rdo_dindingbata') : $this->input->post('lc_dindingbata');
					$rdo_dindingcat = $this->input->post('rdo_dindingcat') > 0 ? $this->input->post('rdo_dindingcat') : $this->input->post('lc_dindingcat');
					$rdo_pintujendelakusen = $this->input->post('rdo_pintujendelakusen') > 0 ? $this->input->post('rdo_pintujendelakusen') : $this->input->post('lc_pintujendelakusen');
					$rdo_pintujendeladaunp = $this->input->post('rdo_pintujendeladaunp') > 0 ? $this->input->post('rdo_pintujendeladaunp') : $this->input->post('lc_pintujendeladaunp');
					$rdo_pintujendeladaunj = $this->input->post('rdo_pintujendeladaunj') > 0 ? $this->input->post('rdo_pintujendeladaunj') : $this->input->post('lc_pintujendeladaunj');
					$rdo_lantaistruktur = $this->input->post('rdo_lantaistruktur') > 0 ? $this->input->post('rdo_lantaistruktur') : $this->input->post('lc_lantaistruktur');
					$rdo_lantaipenutup = $this->input->post('rdo_lantaipenutup') > 0 ? $this->input->post('rdo_lantaipenutup') : $this->input->post('lc_lantaipenutup');
					$rdo_pondasi = $this->input->post('rdo_pondasi') > 0 ? $this->input->post('rdo_pondasi') : $this->input->post('lc_pondasi');
					$rdo_pondasisloof = $this->input->post('rdo_pondasisloof') > 0 ? $this->input->post('rdo_pondasisloof') : $this->input->post('lc_pondasisloof');
					$rdo_utilitaslistrik = $this->input->post('rdo_utilitaslistrik') > 0 ? $this->input->post('rdo_utilitaslistrik') : $this->input->post('lc_utilitaslistrik');
					$rdo_utilitasinstalasiair = $this->input->post('rdo_utilitasinstalasiair') > 0 ? $this->input->post('rdo_utilitasinstalasiair') : $this->input->post('lc_utilitasinstalasiair');

					$data['RDOATAPPENUTUP'] = $rdo_atappenutup;
					$data['RDOATAPRANGKA'] = $rdo_ataprangka;
					$data['RDOATAPLIS'] = $rdo_ataplis;
					$data['RDOPLAFONRANGKA'] = $rdo_plafonrangka;
					$data['RDOPLAFONPENUTUP'] = $rdo_plafonpenutup;
					$data['RDOPLAFONCAT'] = $rdo_plafoncat;
					$data['RDODINDINGKOLOM'] = $rdo_dindingkolom;
					$data['RDODINDINGBATA'] = $rdo_dindingbata;
					$data['RDODINDINGCAT'] = $rdo_dindingcat;
					$data['RDOPINTUJENDELAKUSEN'] = $rdo_pintujendelakusen;
					$data['RDOPINTUJENDELADAUNP'] = $rdo_pintujendeladaunp;
					$data['RDOPINTUJENDELADAUNJ'] = $rdo_pintujendeladaunj;
					$data['RDOLANTAISTRUKTUR'] = $rdo_lantaistruktur;
					$data['RDOLANTAIPENUTUP'] = $rdo_lantaipenutup;
					$data['RDOPONDASI'] = $rdo_pondasi;
					$data['RDOPONDASISLOOF'] = $rdo_pondasisloof;
					$data['RDOUTILITASLISTRIK'] = $rdo_utilitaslistrik;
					$data['RDOUTILITASINSTALASIAIR'] = $rdo_utilitasinstalasiair;

					$data['TOTAL'] = $this->input->post('txt_total');
                                        $data['NOTE'] = $this->input->post('txt_note');
					$data['VIDEONAME'] = $videoname;
                                        //$data['VIDEONAME'] = $getfiledata['raw_name'].'.'.'flv';
					$data['VIDEO'] = $video;
					$data['FILETYPE'] = $filetype;
					$data['CREATED'] = $created;
					
				 //    echo "<pre>";
					// print_r($data);
					// print_r($uploaddata);
					// echo "</pre>";
					// die();

					$res=$this->modelsip4->add_data('trx_progress1',$data);
					if($res>=1){
						$this->session->set_flashdata('successalert','Data berhasil ditambahkan');
						redirect('progress');
					}else{
						$this->session->set_flashdata('erroralert','Data gagal ditambahkan. Pesan error : '.$this->db->_error_message());
						redirect('progress');
					}	
				}		
			}
		}
		// if($this->input->post('btn_cancel')){
		// 	redirect('progress');
		// }

		$this->db->db_debug = $db_debug; //restore setting
	}

	// Array
	// (
	//     [upload_data] => Array
	//         (
	//             [file_name] => 5555_1__12288989_657293067706971_1750760112_n1.mp4
	//             [file_type] => video/mp4
	//             [file_path] => C:/xampp/htdocs/sip4/files/video/
	//             [full_path] => C:/xampp/htdocs/sip4/files/video/5555_1__12288989_657293067706971_1750760112_n1.mp4
	//             [raw_name] => 5555_1__12288989_657293067706971_1750760112_n1
	//             [orig_name] => 5555_1__12288989_657293067706971_1750760112_n.mp4
	//             [client_name] => 12288989_657293067706971_1750760112_n.mp4
	//             [file_ext] => .mp4
	//             [file_size] => 9607.38
	//             [is_image] => 
	//             [image_width] => 
	//             [image_height] => 
	//             [image_type] => 
	//             [image_size_str] => 
	//         )

	// )

	public function delete($progressid){
		$db_debug = $this->db->db_debug; //save setting
		$this->db->db_debug = FALSE; //disable debugging for queries

		$video = $this->modelsip4->link_photo($progressid);

		if ($video->num_rows() > 0)
		{
		
			$row = $video->row();
					
			$file_photo = $row->VIDEO;
			
			$path_file = './files/video/';
			unlink($path_file.$file_photo);
			
		}   

		$where['PROGRESSID'] = $progressid;
		$res=$this->modelsip4->delete_data('trx_progress1',$where);
		if($res>=1){
			$this->session->set_flashdata('successalert','Data progress dengan ID '.$progressid.' berhasil dihapus');
			redirect('progress');
		}else{
			$this->session->set_flashdata('erroralert','Data progress dengan ID '.$progressid.' gagal dihapus. Pesan error : '.$this->db->_error_message());
			redirect('progress');
		}

		$this->db->db_debug = $db_debug; //restore setting
	}

	public function view($progressid){
		$query3 = "select 

			tpg.PROCNUMBER as PROCNUMBER,
			tp.PROCDESC as PROCDESC, 
			rs.SUBDISTRICT as SUBDISTRICT,
			tp.SCHOOLLEVEL as SCHOOLLEVEL,  
			tpg.STEP as STEP, 
			tp.ENDDATE as ENDDATE, 
			rsv.SVNAME as SVNAME,
			rpv.PVNAME as PVNAME,
            DATE_FORMAT(tt.DUEDATE,'%d-%m-%Y') as DUEDATE, 
            DATE_FORMAT(tpg.CREATED,'%d-%m-%Y %H:%i:%s') as CREATED,
            tt.SUBCONTRACTVALUE as SUBCONTRACTVALUE,
            tp.PROCTYPECODE as PROCTYPECODE, 
			rpt.PROCTYPEDESC as PROCTYPEDESC, 
			tp.CONTRACTVALUE as CONTRACTVALUE,

			tpg.ATAPPENUTUP as ATAPPENUTUP, 
			tpg.ATAPRANGKA as ATAPRANGKA, 
			tpg.ATAPLIS as ATAPLIS, 
			tpg.PLAFONRANGKA as PLAFONRANGKA, 
			tpg.PLAFONPENUTUP as PLAFONPENUTUP, 
			tpg.PLAFONCAT as PLAFONCAT, 
			tpg.DINDINGKOLOM as DINDINGKOLOM, 
			tpg.DINDINGBATA as DINDINGBATA, 
			tpg.DINDINGCAT as DINDINGCAT, 
			tpg.PINTUJENDELAKUSEN as PINTUJENDELAKUSEN, 
			tpg.PINTUJENDELADAUNP as PINTUJENDELADAUNP, 
			tpg.PINTUJENDELADAUNJ as PINTUJENDELADAUNJ, 
			tpg.LANTAISTRUKTUR as LANTAISTRUKTUR, 
			tpg.LANTAIPENUTUP as LANTAIPENUTUP, 
			tpg.PONDASI as PONDASI, 
			tpg.PONDASISLOOF as PONDASISLOOF, 
			tpg.UTILITASLISTRIK as UTILITASLISTRIK, 
			tpg.UTILITASINSTALASIAIR as UTILITASINSTALASIAIR,

			tpg.RDOATAPPENUTUP as RDOATAPPENUTUP, 
			tpg.RDOATAPRANGKA as RDOATAPRANGKA, 
			tpg.RDOATAPLIS as RDOATAPLIS, 
			tpg.RDOPLAFONRANGKA as RDOPLAFONRANGKA, 
			tpg.RDOPLAFONPENUTUP as RDOPLAFONPENUTUP, 
			tpg.RDOPLAFONCAT as RDOPLAFONCAT, 
			tpg.RDODINDINGKOLOM as RDODINDINGKOLOM, 
			tpg.RDODINDINGBATA as RDODINDINGBATA, 
			tpg.RDODINDINGCAT as RDODINDINGCAT, 
			tpg.RDOPINTUJENDELAKUSEN as RDOPINTUJENDELAKUSEN, 
			tpg.RDOPINTUJENDELADAUNP as RDOPINTUJENDELADAUNP, 
			tpg.RDOPINTUJENDELADAUNJ as RDOPINTUJENDELADAUNJ, 
			tpg.RDOLANTAISTRUKTUR as RDOLANTAISTRUKTUR, 
			tpg.RDOLANTAIPENUTUP as RDOLANTAIPENUTUP, 
			tpg.RDOPONDASI as RDOPONDASI, 
			tpg.RDOPONDASISLOOF as RDOPONDASISLOOF, 
			tpg.RDOUTILITASLISTRIK as RDOUTILITASLISTRIK, 
			tpg.RDOUTILITASINSTALASIAIR as RDOUTILITASINSTALASIAIR, 
			
			tpg.VIDEONAME as VIDEONAME,
			tpg.VIDEO as VIDEO,
			tpg.FILETYPE as FILETYPE,
			tpg.TOTAL as TOTAL,
            tpg.NOTE as NOTE
			
			from trx_progress1 tpg 
			left join trx_procurement tp on tp.PROCNUMBER = tpg.PROCNUMBER
			left join ref_procurementtype rpt on rpt.PROCTYPECODE = tp.PROCTYPECODE 
			left join ref_subdistrict rs on rs.SUBDISTRICTID = tp.SUBDISTRICTID
			left join ref_supervisor rsv on rsv.SVCODE = tp.SVCODE
			left join ref_provider rpv on rpv.PVCODE = tp.PVCODE
			left join trx_termin tt on tt.PROCNUMBER = tpg.PROCNUMBER
            						and tt.STEP = tpg.STEP
			where tpg.PROGRESSID = '$progressid' ";

		$result3 = $this->modelsip4->get_data($query3);
		
		$progress['PROGRESSID'] = $progressid;
		$progress['PROCNUMBER'] = $result3[0]['PROCDESC'];
		$progress['PROCDESC'] = $result3[0]['PROCDESC'];
		$progress['SUBDISTRICT'] = $result3[0]['SUBDISTRICT'];
		$progress['SCHOOLLEVEL'] = $result3[0]['SCHOOLLEVEL'];
		$progress['STEP'] = $result3[0]['STEP'];
		$progress['ENDDATE'] = $result3[0]['ENDDATE'];
		$progress['SVNAME'] = $result3[0]['SVNAME'];
		$progress['PVNAME'] = $result3[0]['PVNAME'];
		$progress['DUEDATE'] = $result3[0]['DUEDATE'];
		$progress['CREATED'] = $result3[0]['CREATED'];
		$progress['SUBCONTRACTVALUE'] = $result3[0]['SUBCONTRACTVALUE'];
		$progress['PROCTYPECODE'] = $result3[0]['PROCTYPECODE'];
		$progress['PROCTYPEDESC'] = $result3[0]['PROCTYPEDESC'];
		$progress['CONTRACTVALUE'] = $result3[0]['CONTRACTVALUE'];

			// $progress['ATAPPENUTUP'] = 0.0;
			// $progress['ATAPRANGKA'] = 0.0;
			// $progress['ATAPLIS'] = 0.0;
			// $progress['PLAFONRANGKA'] = 0.0;
			// $progress['PLAFONPENUTUP'] = 0.0;
			// $progress['PLAFONCAT'] = 0.0;
			// $progress['DINDINGKOLOM'] = 0.0;
			// $progress['DINDINGBATA'] = 0.0;
			// $progress['DINDINGCAT'] = 0.0;
			// $progress['PINTUJENDELAKUSEN'] = 0.0;
			// $progress['PINTUJENDELADAUNP'] = 0.0;
			// $progress['PINTUJENDELADAUNJ'] = 0.0;
			// $progress['LANTAISTRUKTUR'] = 0.0;
			// $progress['LANTAIPENUTUP'] = 0.0;
			// $progress['PONDASI'] = 0.0;
			// $progress['PONDASISLOOF'] = 0.0;
			// $progress['UTILITASLISTRIK'] = 0.0;
			// $progress['UTILITASINSTALASIAIR'] = 0.0;

		$progress['ATAPPENUTUP'] = round($result3[0]['ATAPPENUTUP'],2);
		$progress['ATAPRANGKA'] = round($result3[0]['ATAPRANGKA'],2);
		$progress['ATAPLIS'] = round($result3[0]['ATAPLIS'],2);
		$progress['PLAFONRANGKA'] = round($result3[0]['PLAFONRANGKA'],2);
		$progress['PLAFONPENUTUP'] = round($result3[0]['PLAFONPENUTUP'],2);
		$progress['PLAFONCAT'] = round($result3[0]['PLAFONCAT'],2);
		$progress['DINDINGKOLOM'] = round($result3[0]['DINDINGKOLOM'],2);
		$progress['DINDINGBATA'] = round($result3[0]['DINDINGBATA'],2);
		$progress['DINDINGCAT'] = round($result3[0]['DINDINGCAT'],2);
		$progress['PINTUJENDELAKUSEN'] = round($result3[0]['PINTUJENDELAKUSEN'],2);
		$progress['PINTUJENDELADAUNP'] = round($result3[0]['PINTUJENDELADAUNP'],2);
		$progress['PINTUJENDELADAUNJ'] = round($result3[0]['PINTUJENDELADAUNJ'],2);
		$progress['LANTAISTRUKTUR'] = round($result3[0]['LANTAISTRUKTUR'],2);
		$progress['LANTAIPENUTUP'] = round($result3[0]['LANTAIPENUTUP'],2);
		$progress['PONDASI'] = round($result3[0]['PONDASI'],2);
		$progress['PONDASISLOOF'] = round($result3[0]['PONDASISLOOF'],2);
		$progress['UTILITASLISTRIK'] = round($result3[0]['UTILITASLISTRIK'],2);
		$progress['UTILITASINSTALASIAIR'] = round($result3[0]['UTILITASINSTALASIAIR'],2);

		$progress['RDOATAPPENUTUP'] = $result3[0]['RDOATAPPENUTUP'];
		$progress['RDOATAPRANGKA'] = $result3[0]['RDOATAPRANGKA'];
		$progress['RDOATAPLIS'] = $result3[0]['RDOATAPLIS'];
		$progress['RDOPLAFONRANGKA'] = $result3[0]['RDOPLAFONRANGKA'];
		$progress['RDOPLAFONPENUTUP'] = $result3[0]['RDOPLAFONPENUTUP'];
		$progress['RDOPLAFONCAT'] = $result3[0]['RDOPLAFONCAT'];
		$progress['RDODINDINGKOLOM'] = $result3[0]['RDODINDINGKOLOM'];
		$progress['RDODINDINGBATA'] = $result3[0]['RDODINDINGBATA'];
		$progress['RDODINDINGCAT'] = $result3[0]['RDODINDINGCAT'];
		$progress['RDOPINTUJENDELAKUSEN'] = $result3[0]['RDOPINTUJENDELAKUSEN'];
		$progress['RDOPINTUJENDELADAUNP'] = $result3[0]['RDOPINTUJENDELADAUNP'];
		$progress['RDOPINTUJENDELADAUNJ'] = $result3[0]['RDOPINTUJENDELADAUNJ'];
		$progress['RDOLANTAISTRUKTUR'] = $result3[0]['RDOLANTAISTRUKTUR'];
		$progress['RDOLANTAIPENUTUP'] = $result3[0]['RDOLANTAIPENUTUP'];
		$progress['RDOPONDASI'] = $result3[0]['RDOPONDASI'];
		$progress['RDOPONDASISLOOF'] = $result3[0]['RDOPONDASISLOOF'];
		$progress['RDOUTILITASLISTRIK'] = $result3[0]['RDOUTILITASLISTRIK'];
		$progress['RDOUTILITASINSTALASIAIR'] = $result3[0]['RDOUTILITASINSTALASIAIR'];

		// $progress2['RDOATAPPENUTUP'] = 0.0;
		// $progress2['RDOATAPRANGKA'] = 0.0;
		// $progress2['RDOATAPLIS'] = 0.0;
		// $progress2['RDOPLAFONRANGKA'] = 0.0;
		// $progress2['RDOPLAFONPENUTUP'] = 0.0;
		// $progress2['RDOPLAFONCAT'] = 0.0;
		// $progress2['RDODINDINGKOLOM'] = 0.0;
		// $progress2['RDODINDINGBATA'] = 0.0;
		// $progress2['RDODINDINGCAT'] = 0.0;
		// $progress2['RDOPINTUJENDELAKUSEN'] = 0.0;
		// $progress2['RDOPINTUJENDELADAUNP'] = 0.0;
		// $progress2['RDOPINTUJENDELADAUNJ'] = 0.0;
		// $progress2['RDOLANTAISTRUKTUR'] = 0.0;
		// $progress2['RDOLANTAIPENUTUP'] = 0.0;
		// $progress2['RDOPONDASI'] = 0.0;
		// $progress2['RDOPONDASISLOOF'] = 0.0;
		// $progress2['RDOUTILITASLISTRIK'] = 0.0;
		// $progress2['RDOUTILITASINSTALASIAIR'] = 0.0;

		$progress['TOTAL'] = round($result3[0]['TOTAL'],2);
                $progress['NOTE'] = $result3[0]['NOTE'];
		$progress['VIDEONAME'] = $result3[0]['VIDEONAME'];
		$progress['VIDEO'] = $result3[0]['VIDEO'];
		$progress['FILETYPE'] = $result3[0]['FILETYPE'];

			// $progress['procurementlist'] = $result2;
		$data['data'] = $progress;
		// $data['data2'] = $progress2;
	        
	    // $content['currentpage'] = "progress";
	    $content['contentheader'] = "Detail Data Progress";
	    $content['navigation'] = $this->load->view($this->nav,array("currentpage"=>"progress"),true);
	    $content['contentheaderactive'] = "<li><a href='#'> Data Progress</a></li><li class='active'> Detail Data Progress</li>";
	    $content['content'] = $this->load->view('progress/view',$data,true);

		$this->load->view('dashboard',$content);
	}

	// public function upload() {
 //        if (!empty($_FILES)) {
 //        $tempFile = $_FILES['file']['tmp_name'];
 //        $fileName = $_FILES['file']['name'];
 //        $targetPath = getcwd() . '/files/video/';
 //        $targetFile = $targetPath . $fileName ;
 //        move_uploaded_file($tempFile, $targetFile);
 //        // if you want to save in db,where here
 //        // with out model just for example
 //        // $this->load->database(); // load database
 //        // $this->db->insert('file_table',array('file_name' => $fileName));
 //        }
 //    }

	// public function entryedit($progressid){
	// 	$query = "select * from trx_progress where PROGRESSID = '$progressid'";
	// 	$result = $this->modelsip4->get_data($query);

	// 	$query2 = "select * from trx_procurement order by PROCNUMBER";
	// 	$result2 = $this->modelsip4->get_data($query2);

	// 	$progress['PROCNUMBER'] = $result[0]['PROCNUMBER'];
	// 	$progress['STEP'] = $result[0]['STEP'];
	// 	$progress['ATAPPENUTUP'] = $result[0]['ATAPPENUTUP'];
	// 	$progress['ATAPRANGKA'] = $result[0]['ATAPRANGKA'];
	// 	$progress['ATAPLIS'] = $result[0]['ATAPLIS'];
	// 	$progress['PLAFONRANGKA'] = $result[0]['PLAFONRANGKA'];
	// 	$progress['PLAFONPENUTUP'] = $result[0]['PLAFONPENUTUP'];
	// 	$progress['PLAFONCAT'] = $result[0]['PLAFONCAT'];
	// 	$progress['DINDINGKOLOM'] = $result[0]['DINDINGKOLOM'];
	// 	$progress['DINDINGBATA'] = $result[0]['DINDINGBATA'];
	// 	$progress['DINDINGCAT'] = $result[0]['DINDINGCAT'];
	// 	$progress['PINTUJENDELAKUSEN'] = $result[0]['PINTUJENDELAKUSEN'];
	// 	$progress['PINTUJENDELADAUNP'] = $result[0]['PINTUJENDELADAUNP'];
	// 	$progress['PINTUJENDELADAUNJ'] = $result[0]['PINTUJENDELADAUNJ'];
	// 	$progress['LANTAISTRUKTUR'] = $result[0]['LANTAISTRUKTUR'];
	// 	$progress['LANTAIPENUTUP'] = $result[0]['LANTAIPENUTUP'];
	// 	$progress['PONDASI'] = $result[0]['PONDASI'];
	// 	$progress['PONDASISLOOF'] = $result[0]['PONDASISLOOF'];
	// 	$progress['UTILITASLISTRIK'] = $result[0]['UTILITASLISTRIK'];
	// 	$progress['UTILITASINSTALASIAIR'] = $result[0]['UTILITASINSTALASIAIR'];
	// 	$progress['TOTAL'] = $result[0]['TOTAL'];
	// 	$progress['VIDEO'] = $result[0]['VIDEO'];
	// 	$progress['procurementlist'] = $result2;
	// 	$data['data'] = $progress;
        
 //        $content['currentpage'] = "progress";
 //        $content['contentheader'] = "Ubah Data Progress";
 //        $content['contentheaderactive'] = "<li><a href='#'> Data Progress</a></li><li class='active'> Ubah Data Progress</li>";
 //        $content['content'] = $this->load->view('progress/edit',$data,true);

	// 	$this->load->view('dashboard',$content);
	// }

	// public function edit($progressid){
	// 	$db_debug = $this->db->db_debug; //save setting
	// 	$this->db->db_debug = FALSE; //disable debugging for queries

	// 	$this->form_validation->set_rules('cmb_proc','Nama Kegiatan','required');
	// 	$this->form_validation->set_rules('txt_step','Step','required');
	// 	$this->form_validation->set_rules('txt_atappenutup','Penutup Atap','required');
	// 	$this->form_validation->set_rules('txt_ataprangka','Rangka Atap','required');
	// 	$this->form_validation->set_rules('txt_ataplis','Lis Plang & Talang','required');
	// 	$this->form_validation->set_rules('txt_plafonrangka','Rangka Plafon','required');
	// 	$this->form_validation->set_rules('txt_plafonpenutup','Penutup & Lis Plafon','required');
	// 	$this->form_validation->set_rules('txt_plafoncat','Cat','required');
	// 	$this->form_validation->set_rules('txt_dindingkolom','Kolom & Balok Ring','required');
	// 	$this->form_validation->set_rules('txt_dindingbata','Bata/Dinding Pengisi','required');
	// 	$this->form_validation->set_rules('txt_dindingcat','Cat','required');
	// 	$this->form_validation->set_rules('txt_pintujendelakusen','Kusen','required');
	// 	$this->form_validation->set_rules('txt_pintujendeladaunp','Daun Pintu','required');
	// 	$this->form_validation->set_rules('txt_pintujendeladaunj','Daun Jendela','required');
	// 	$this->form_validation->set_rules('txt_lantaistruktur','Struktur Bawah','required');
	// 	$this->form_validation->set_rules('txt_lantaipenutup','Penutup Lantai','required');
	// 	$this->form_validation->set_rules('txt_pondasi','Pondasi','required');
	// 	$this->form_validation->set_rules('txt_pondasisloof','Sloof','required');
	// 	$this->form_validation->set_rules('txt_utilitaslistrik','Listrik','required');
	// 	$this->form_validation->set_rules('txt_utilitasinstalasiair','Instalasi Air Hujan & Pasangan Rabat Beton Keliling Bangunan','required');
	// 	$this->form_validation->set_rules('txt_total','Jumlah','required');
	// 	$this->form_validation->set_rules('txt_video','Video','required');
	// 	if($this->input->post('btn_save')){
	// 		if($this->form_validation->run()==FALSE){
	// 			$query2 = "select * from trx_procurement order by PROCNUMBER";
	// 			$result2 = $this->modelsip4->get_data($query2);

	// 			$progress['PROCNUMBER'] = $this->input->post('cmb_proc');
	// 			$progress['STEP'] = $this->input->post('txt_step');
	// 			$progress['ATAPPENUTUP'] = $this->input->post('txt_atappenutup');
	// 			$progress['ATAPRANGKA'] = $this->input->post('txt_ataprangka');
	// 			$progress['ATAPLIS'] = $this->input->post('txt_ataplis');
	// 			$progress['PLAFONRANGKA'] = $this->input->post('txt_plafonrangka');
	// 			$progress['PLAFONPENUTUP'] = $this->input->post('txt_plafonpenutup');
	// 			$progress['PLAFONCAT'] = $this->input->post('txt_plafoncat');
	// 			$progress['DINDINGKOLOM'] = $this->input->post('txt_dindingkolom');
	// 			$progress['DINDINGBATA'] = $this->input->post('txt_dindingbata');
	// 			$progress['DINDINGCAT'] = $this->input->post('txt_dindingcat');
	// 			$progress['PINTUJENDELAKUSEN'] = $this->input->post('txt_pintujendelakusen');
	// 			$progress['PINTUJENDELADAUNP'] = $this->input->post('txt_pintujendeladaunp');
	// 			$progress['PINTUJENDELADAUNJ'] = $this->input->post('txt_pintujendeladaunj');
	// 			$progress['LANTAISTRUKTUR'] = $this->input->post('txt_lantaistruktur');
	// 			$progress['LANTAIPENUTUP'] = $this->input->post('txt_lantaipenutup');
	// 			$progress['PONDASI'] = $this->input->post('txt_pondasi');
	// 			$progress['PONDASISLOOF'] = $this->input->post('txt_pondasisloof');
	// 			$progress['UTILITASLISTRIK'] = $this->input->post('txt_utilitaslistrik');
	// 			$progress['UTILITASINSTALASIAIR'] = $this->input->post('txt_utilitasinstalasiair');
	// 			$progress['TOTAL'] = $this->input->post('txt_total');
	// 			$progress['VIDEO'] = $this->input->post('txt_video');
	// 			$progress['procurementlist'] = $result2;
	// 			$data['data'] = $progress;
		        
	// 	        $content['currentpage'] = "progress";
	// 	        $content['contentheader'] = "Ubah Data Progress";
	// 	        $content['contentheaderactive'] = "<li><a href='#'> Data Progress</a></li><li class='active'> Ubah Data Progress</li>";
	// 	        $content['content'] = $this->load->view('progress/edit',$data,true);

	// 			$this->load->view('dashboard',$content);
	// 		}else{
	// 			$data['PROCNUMBER'] = $this->input->post('cmb_proc');
	// 			$data['STEP'] = $this->input->post('txt_step');
	// 			$data['ATAPPENUTUP'] = $this->input->post('txt_atappenutup');
	// 			$data['ATAPRANGKA'] = $this->input->post('txt_ataprangka');
	// 			$data['ATAPLIS'] = $this->input->post('txt_ataplis');
	// 			$data['PLAFONRANGKA'] = $this->input->post('txt_plafonrangka');
	// 			$data['PLAFONPENUTUP'] = $this->input->post('txt_plafonpenutup');
	// 			$data['PLAFONCAT'] = $this->input->post('txt_plafoncat');
	// 			$data['DINDINGKOLOM'] = $this->input->post('txt_dindingkolom');
	// 			$data['DINDINGBATA'] = $this->input->post('txt_dindingbata');
	// 			$data['DINDINGCAT'] = $this->input->post('txt_dindingcat');
	// 			$data['PINTUJENDELAKUSEN'] = $this->input->post('txt_pintujendelakusen');
	// 			$data['PINTUJENDELADAUNP'] = $this->input->post('txt_pintujendeladaunp');
	// 			$data['PINTUJENDELADAUNJ'] = $this->input->post('txt_pintujendeladaunj');
	// 			$data['LANTAISTRUKTUR'] = $this->input->post('txt_lantaistruktur');
	// 			$data['LANTAIPENUTUP'] = $this->input->post('txt_lantaipenutup');
	// 			$data['PONDASI'] = $this->input->post('txt_pondasi');
	// 			$data['PONDASISLOOF'] = $this->input->post('txt_pondasisloof');
	// 			$data['UTILITASLISTRIK'] = $this->input->post('txt_utilitaslistrik');
	// 			$data['UTILITASINSTALASIAIR'] = $this->input->post('txt_utilitasinstalasiair');
	// 			$data['TOTAL'] = $this->input->post('txt_total');
	// 			$data['VIDEO'] = $this->input->post('txt_video');
	// 			$where['PROGRESSID'] = $progressid;
	// 			$res=$this->modelsip4->edit_data('trx_progress1',$data,$where);
	// 			if($res>=1){
	// 				$this->session->set_flashdata('successalert','Data kegiatan dengan ID '.$progressid.' berhasil diubah');
	// 				redirect('progress');
	// 			}else{
	// 				$this->session->set_flashdata('erroralert','Data kegiatan dengan ID '.$progressid.' gagal diubah. Pesan error : '.$this->db->_error_message());
	// 				redirect('progress');
	// 			}			
	// 		}
	// 	}
	// 	if($this->input->post('btn_cancel')){
	// 		redirect('progress');
	// 	}

	// 	$this->db->db_debug = $db_debug; //restore setting
	// }
}
