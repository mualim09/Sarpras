<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modellogin extends CI_Model {
	public function usercheck($user, $pass)
	{
		$rtn = false;

		$query = "select * from sys_useraccess where USERNAME='$user' and PASSWORD = '$pass'"; 
		$result = $this->db->query($query);
		
		if ($result->num_rows() == 0) {
        	// username dan password tsb tidak ada 
			return $rtn;
		} else {
			$queryupdate = "update sys_useraccess set STATUS = 1, LASTLOGIN = now() where USERNAME='$user'";
			$resultupdate = $this->db->query($queryupdate);

			if ($resultupdate>=1) {
				// ada, maka ambil informasi dari database
				$query2="select 
					su.USERNAME as USERNAME, 
					su.PASSWORD as PASSWORD, 
					su.LEVEL as LEVEL, 
					ru.NAME as NAME, 
					su.STATUS as STATUS, 
					su.SESSIONID as SESSIONID, 
					ru.USERCODE as USERCODE,
					ru.SVCODE as SVCODE,
					rs.SVNAME as SVNAME,
					DATE_FORMAT(su.LASTLOGIN, '%d %M %Y %H:%i:%s') as LASTLOGIN 
					from sys_useraccess su 
					left join ref_userprofile ru on ru.USERCODE = su.USERCODE 
					left join ref_supervisor rs on rs.SVCODE = ru.SVCODE
					where su.USERNAME='$user'"; 
				$result2=$this->db->query($query2);

				$userdata = $result2->row();
				
				$session_data = array(
					'USERNAME' => $userdata->USERNAME,
					'PASSWORD' => $userdata->PASSWORD,
					'LEVEL' => $userdata->LEVEL,
					'NAME' => $userdata->NAME,
					'STATUS' => $userdata->STATUS,
					'SESSIONID' => $userdata->SESSIONID,
					'USERCODE' => $userdata->USERCODE,
					'SVCODE' => $userdata->SVCODE,
					'SVNAME' => $userdata->SVNAME,
					'LASTLOGIN' => $userdata->LASTLOGIN,
					'is_login' => true,
					);
	         	
	         	// buat session
				$this->session->set_userdata($session_data);
				
				$rtn = true;
			} else {
				$rtn = false;
			}
			
        	return $rtn;
		}        
	}
}
