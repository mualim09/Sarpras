<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelsip4 extends CI_Model {
	public function get_data($query=""){
		$data=$this->db->query($query);
		return $data->result_array();
	}

	public function add_data($tablename,$data){
		$res=$this->db->insert($tablename,$data);
		return $res;
	}

	public function edit_data($tablename,$data,$where){
		$res=$this->db->update($tablename,$data,$where);
		return $res;
	}

	public function delete_data($tablename,$where){
		$res=$this->db->delete($tablename,$where);
		return $res;
	}

	public function add_trx_procurement($tablename,$tablename2,$data,$data2){
		$res = 0;

		$this->db->trans_begin();

		$this->db->insert($tablename,$data);
		for($i=0; $i<count($data2['STEP']); $i++){
			// $idata2=array(
			// 	"IDKOMPONEN"=>$data['IDKOMPONEN'],
			// 	"IDSUBKOMPONEN"=>$data['IDSUBKOMPONEN'],
			// 	"SUBKOMPONEN"=>$data['SUBKOMPONEN'],
			// 	"BOBOTKERUSAKAN"=>$data['BOBOTKERUSAKAN'][$i],
			// 	"PROSENTASEKERUSAKAN"=>$data['PROSENTASEKERUSAKAN'][$i],
			// 	);
			$idata2['PROCNUMBER'] = $data2['PROCNUMBER'];
			$idata2['STEP'] = $data2['STEP'][$i];
			$idata2['INDEXDAY'] = $data2['INDEXDAY'][$i];
			$idata2['ALERTDATE'] = $data2['ALERTDATE'][$i];
			$idata2['DUEDATE'] = $data2['DUEDATE'][$i];
			$idata2['SUBCONTRACTVALUE'] = $data2['SUBCONTRACTVALUE'][$i];	

			// echo "<pre>";
			// print_r($dt);
			// echo "</pre>";
			$this->db->insert($tablename2,$idata2);

		}
		
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
			//Tulis pesan gagal
			$res = 0;
		}
		else
		{
		    $this->db->trans_commit();
			//Tulis pesan berhasil
			$res = 1;
		}

		return $res;
	}

	public function edit_trx_procurement($tablename,$tablename2,$data,$data2,$where){
		$res = 0;

		$this->db->trans_begin();

		$this->db->update($tablename,$data,$where);
		$this->db->delete($tablename2,$where);
		for($i=0; $i<count($data2['STEP']); $i++){
			$idata2['PROCNUMBER'] = $data2['PROCNUMBER'];
			$idata2['STEP'] = $data2['STEP'][$i];
			$idata2['INDEXDAY'] = $data2['INDEXDAY'][$i];
			$idata2['ALERTDATE'] = $data2['ALERTDATE'][$i];
			$idata2['DUEDATE'] = $data2['DUEDATE'][$i];
			$idata2['SUBCONTRACTVALUE'] = $data2['SUBCONTRACTVALUE'][$i];	

			$this->db->insert($tablename2,$idata2);
		}
		
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
			//Tulis pesan gagal
			$res = 0;
		}
		else
		{
		    $this->db->trans_commit();
			//Tulis pesan berhasil
			$res = 1;
		}

		return $res;
	}

	public function delete_trx_procurement($tablename,$tablename2,$where){
		$res = 0;

		$this->db->trans_begin();

		$this->db->delete($tablename,$where);
		$this->db->delete($tablename2,$where);
				
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
			//Tulis pesan gagal
			$res = 0;
		}
		else
		{
		    $this->db->trans_commit();
			//Tulis pesan berhasil
			$res = 1;
		}

		return $res;
	}

        public function link_photo($progressid){
		
		$this->db->where('PROGRESSID',$progressid);
	    $query = $getData = $this->db->get('trx_progress1');

		if($getData->num_rows() > 0){
			return $query;
		}else{
			return null;
		}			
	}

	// public function add_datasubkomponen($tablename,$data){
	// 	for($i=0; $i<count($data['BOBOTKERUSAKAN']); $i++){
	// 		$dt=array(
	// 			"IDKOMPONEN"=>$data['IDKOMPONEN'],
	// 			"IDSUBKOMPONEN"=>$data['IDSUBKOMPONEN'],
	// 			"SUBKOMPONEN"=>$data['SUBKOMPONEN'],
	// 			"BOBOTKERUSAKAN"=>$data['BOBOTKERUSAKAN'][$i],
	// 			"PROSENTASEKERUSAKAN"=>$data['PROSENTASEKERUSAKAN'][$i],
	// 			);
	// 		// echo "<pre>";
	// 		// print_r($dt);
	// 		// echo "</pre>";
	// 		$res=$this->db->insert($tablename,$dt);
	// 	}
	// 	return $res;
	// }

	// public function add_dataverifikasidetail($tablename,$data){
	// 	for($i=0; $i<count($data['IDSUBKOMPONEN']); $i++){
	// 		// if($this->session->userdata('LEVEL')=="user"){
	// 			$dt=array(
	// 				"IDVERIFIKASI"=>$data['IDVERIFIKASI'],
	// 				"IDSUBKOMPONEN"=>$data['IDSUBKOMPONEN'][$i],
	// 				"BOBOT"=>$data['BOBOT'][$i],
	// 				"NILAI"=>$data['NILAI'][$i],
	// 			);
	// 		// }
	// 		// else{
	// 		// 	$dt=array(
	// 		// 		"IDVERIFIKASI"=>$data['IDVERIFIKASI'],
	// 		// 		"IDSUBKOMPONEN"=>$data['IDSUBKOMPONEN'][$i],
	// 		// 		"BOBOT2"=>$data['BOBOT'][$i],
	// 		// 		"NILAI2"=>$data['NILAI'][$i],
	// 		// 	);
	// 		// }
			
	// 		// echo "<pre>";
	// 		// print_r($dt);
	// 		// echo "</pre>";
	// 		$res=$this->db->insert($tablename,$dt);
	// 	}
	// 	return $res;
	// }
	
	// public function add_bantuan($tablename,$data){
	// 	for($i=0; $i<count($data['IDBANTUAN']); $i++){
	// 		// if($this->session->userdata('LEVEL')=="user"){
	// 			$stat=0;
	// 			if ($data['TAHUN'][$i]!="") {
	// 				$stat=1;
	// 			}
	// 			$dt=array(
	// 				"NPSN"=>$data['NPSN'],
	// 				"IDBANTUAN"=>$data['IDBANTUAN'][$i],
	// 				"NOMORMOU"=>$data['NOMORMOU'][$i],
	// 				"TAHUN"=>$data['TAHUN'][$i],
	// 				"STATUS"=>$stat,
	// 				"CREATED"=>date('Y-m-d H:i:s'),
	// 			);
	// 		// }
	// 		// else{
	// 		// 	$dt=array(
	// 		// 		"IDVERIFIKASI"=>$data['IDVERIFIKASI'],
	// 		// 		"IDSUBKOMPONEN"=>$data['IDSUBKOMPONEN'][$i],
	// 		// 		"BOBOT2"=>$data['BOBOT'][$i],
	// 		// 		"NILAI2"=>$data['NILAI'][$i],
	// 		// 	);
	// 		// }
			
	// 		// echo "<pre>";
	// 		// print_r($dt);
	// 		// echo "</pre>";
	// 		$res=$this->db->insert($tablename,$dt);
	// 	}
	// 	return $res;
	// }

	// public function edit_bantuan($tablename,$data){
	// 	for($i=0; $i<count($data['IDBANTUAN']); $i++){
	// 		$stat=0;
	// 			if ($data['TAHUN'][$i]!="") {
	// 				$stat=1;
	// 			}
	// 			$dt=array(
	// 				"NPSN"=>$data['NPSN'],
	// 				"IDBANTUAN"=>$data['IDBANTUAN'][$i],
	// 				"NOMORMOU"=>$data['NOMORMOU'][$i],
	// 				"TAHUN"=>$data['TAHUN'][$i],
	// 				"STATUS"=>$stat,
	// 				"UPDATED"=>date('Y-m-d H:i:s'),
	// 			);
	// 		// echo "<pre>";
	// 		// print_r($dt);
	// 		// echo "</pre>";
	// 		$where=array(
	// 			"ID"=>$data['ID'][$i],
	// 			);
	// 		$res=$this->db->update($tablename,$dt,$where);
	// 	}
	// 	return $res;
	// }

	// public function edit_datasubkomponen($tablename,$data){
	// 	for($i=0; $i<count($data['BOBOTKERUSAKAN']); $i++){
	// 		$dt=array(
	// 			"IDKOMPONEN"=>$data['IDKOMPONEN'],
	// 			"IDSUBKOMPONEN"=>$data['IDSUBKOMPONEN'],
	// 			"SUBKOMPONEN"=>$data['SUBKOMPONEN'],
	// 			"BOBOTKERUSAKAN"=>$data['BOBOTKERUSAKAN'][$i],
	// 			"PROSENTASEKERUSAKAN"=>$data['PROSENTASEKERUSAKAN'][$i],
	// 			);
	// 		// echo "<pre>";
	// 		// print_r($dt);
	// 		// echo "</pre>";
	// 		$where=array(
	// 			"ID"=>$data['ID'][$i],
	// 			);
	// 		$res=$this->db->update($tablename,$dt,$where);
	// 	}
	// 	return $res;
	// }

	// public function edit_dataverifikasidetail($tablename,$data){
	// 	for($i=0; $i<count($data['IDSUBKOMPONEN']); $i++){
	// 		// if($this->session->userdata('LEVEL')=="user"){
	// 			$dt=array(
	// 				"IDVERIFIKASI"=>$data['IDVERIFIKASI'],
	// 				"IDSUBKOMPONEN"=>$data['IDSUBKOMPONEN'][$i],
	// 				"BOBOT"=>$data['BOBOT'][$i],
	// 				"NILAI"=>$data['NILAI'][$i],
	// 			);
	// 		// }
	// 		// else{
	// 		// 	$dt=array(
	// 		// 		"IDVERIFIKASI"=>$data['IDVERIFIKASI'],
	// 		// 		"IDSUBKOMPONEN"=>$data['IDSUBKOMPONEN'],
	// 		// 		"BOBOT2"=>$data['BOBOT'][$i],
	// 		// 		"NILAI2"=>$data['NILAI'][$i],
	// 		// 	);
	// 		// }
	// 		// echo "<pre>";
	// 		// print_r($dt);
	// 		// echo "</pre>";
	// 		$where=array(
	// 			"ID"=>$data['ID'][$i],
	// 			);
	// 		$res=$this->db->update($tablename,$dt,$where);
	// 	}
	// 	return $res;
	// }

	// public function link_photo($id){
		
	// 	$this->db->where('ID',$id);
	//     $query = $getData = $this->db->get('ref_foto');

	// 	if($getData->num_rows() > 0)
	// 	return $query;
	// 	else
	// 	return null;			
	// }
}
