<?php
class Login {
	var $dbobj;
	
	function Login($dbobj) {
		$this->dbobj=$dbobj;
	}
	
	function Check($id,$pass) {
		//print_r($_SESSION);
		if(str_replace("www.","",trim($_SERVER['HTTP_HOST']))=='matsue.laut-japan.jp') {
		$sql="select * from login where login_id ='$id' and login_pw='$pass'";
		}
		else {

		$sql="select * from login where login_id ='$id' and login_pw='$pass' and login_type <> 20";
		}
		$db=$this->dbobj;
		$result=$db->Query($sql);
		$resultnumrows=$db->NumRows($result);
		//	exit();
		if($resultnumrows!=0) {
			$data=$db->FetchArray($result,0);
			$sql2="select * from domain where domain_name = '".$data["domain"]."'";
		
			$rdata=$db->GetData($sql2);
			$_SESSION["DomainData"]=$rdata;
			return 0;
		}
		else {
			$sql="select * from login where login_id ='$id' and login_pw='$pass' and login_type <> 20";
			//exit();
			$db=$this->dbobj;
			$result=$db->Query($sql);
			$resultnumrows=$db->NumRows($result);
			if($resultnumrows!=0) {
				$_SESSION["DomainData"]=$db->FetchArray($result,0);
				return 100;
			}
			else {
				return 1;
			}
		}
		
	}
	
}
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>