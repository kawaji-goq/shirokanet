<?php 
////session_start();
//mb_language("japanese");
//mb_internal_encoding("euc-jp");
//include $_SERVER["DOCUMENT_ROOT"]."/CUBE/ITC/modules.php";

class Mail_Option {
	var $dbobj;
	function Mail_Option($dbobj) {
		$this->dbobj=$dbobj;
		$res=$dbobj->Query("select * from mail_options where dbname='".$_SESSION["DomainData"]["dbname"]."'");
		$resrows=$dbobj->NumRows($res);
		if($resrows==0) {
		
			$maxdata = $dbobj->GetData("select max(mid) as maxid from mail_options");
			$maxid = $maxdata["maxid"]+1;
  
			$insql=	"insert into mail_options(mid,tmailaddress,tlogin_id,tlogin_pw,tserver,tport,kmailaddress,klogin_id,klogin_pw,kserver,kport,dbname) values (".
							$maxid.",'touroku@".$_SESSION["DomainData"]["domain_name"]."','touroku@".$_SESSION["DomainData"]["domain_name"]."','itc7310','ns.itcube.ne.jp',110,'kaiyaku@".$_SESSION["DomainData"]["domain_name"]."','kaiyaku@".$_SESSION["DomainData"]["domain_name"]."','itc7310','ns.itcube.ne.jp',110,'".$_SESSION["DomainData"]["dbname"]."'".
							")";
			$res = $dbobj->Query($insql);
			
			if(!res) {
				exit("システムエラー<br>管理会社までお問い合わせ下さい。");
			}
			
		}
	}
	
	function GetData($dbname) {
		$sql="select * from mail_options where dbname='".$_SESSION["DomainData"]["dbname"]."'";
		$rdata=$this->dbobj->GetData($sql);
		return $rdata;
	}
	
	function UpDate($pdata) {
		$sql=	"update mail_options set ".
					"reg_subject='".$pdata["reg_subject"]."',".
					"reg_message='".$pdata["reg_message"]."',".
					"dreg_subject='".$pdata["dreg_subject"]."',".
					"dreg_message='".$pdata["dreg_message"]."',".
					"unreg_subject='".$pdata["unreg_subject"]."',".
					"unreg_message='".$pdata["unreg_message"]."'".
					" where dbname = '".$_SESSION["DomainData"]["dbname"]."'";
		$res=$this->dbobj->Query($sql);
		return $res;
	}
}

class User_Model {
	function MailType($addresss) {
		$agenttype=$addresss;
		
		if(substr_count($agenttype,"docomo")!=0) {
			return "k";
		}
		else if(substr_count($agenttype,"ezweb")!=0) {
			return "k";
		}
		else if(substr_count($agenttype,"j-phone")!=0) {
			return "k";
		}
		else if(substr_count($agenttype,"vodafone")!=0) {
			return "k";
		}
		else if(substr_count($agenttype,"softbank")!=0) {
			return "k";
		}
		else {
			return "p";
		}
		
	}	
}
$_CUBE["SIMGSIZE_W"]="150";
$_CUBE["SIMGSIZE_H"]="113";
$_CUBE["MIMGSIZE_W"]="660";
$_CUBE["MIMGSIZE_H"]="495";
$_CUBE["LIMGSIZE_W"]="800";
$_CUBE["LIMGSIZE_H"]="600";
$_CUBE["LEFTBANNER_W"]="182";
$_CUBE["TOPBANNER_W"]="660";
?>
