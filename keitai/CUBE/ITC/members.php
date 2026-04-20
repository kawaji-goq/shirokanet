<?php
class Members {

	var $dbobj;
	
	function Members($dbobj) {
		$this->dbobj=$dbobj;
	}
	
	function GetList($tablename,$key) {
		$sql="select * from ".$tablename." where kana=".$key." order by hurigana";
		$db=$this->dbobj;
		$data=$db->GetList($sql);
		return $data;
	}
	
	function getList2() {
		$sql="select * from member order by turn";
		$db=$this->dbobj;		
		$data=$db->GetList($sql);
		return $data;
	}
	
	function GetALLList() {
		$sql="select * from member order by turn";
		$db=$this->dbobj;
		$data=$db->GetList($sql);
		return $data;
	}
	
	function GetData($tablename,$id) {
		$sql="select * from ".$tablename." where member_id=".$id;
		$db=$this->dbobj;
		$data=$db->GetData($sql);
		return $data;
	}
	
	function GetMaxData($tablename) {
		$sql="select count(member_id) as maxrows from ".$tablename;
		$db=$this->dbobj;
		$data=$db->GetData($sql);
		return $data["maxrows"];
	}
	
	function Addition($tablename,$data) {
		$db=$this->dbobj;
		$sql="select max(member_id) as maxid from ".$tablename."";
		$maxid=1;
		$maxdata=$db->GetData($sql);
		$maxid+=$maxdata["maxid"];
		
		$insql="insert into ".$tablename." (news_id,title,url,target,registdate)".
				" values (".
				$maxid.",".
				"'".$data["title"]."'".",".
				"'".$data["url"]."'".",".
				"'".$data["target"]."'".",".
				"'".$data["rdate"]."'".
				")";
				
		$result=$db->Query($insql);
		return $result;
	}
	
	function Update($tablename,$data) {
		$upsql=	"update ".$tablename." set ".
				"title = '".$data["title"]."',".
				"url = '".$data["url"]."',".
				"target = '".$data["target"]."',".
				"registdate = '".$data["rdate"]."'".
				" where news_id = ".$data["news_id"];
		$result=$this->dbobj->Query($upsql);
		return $result;
	}
	
	function Delete($tablename,$id) {
		$delsql="delete from ".$tablename." where news_id = ".$id;
		$result=$this->dbobj->Query($delsql);
		
	}
}
/*
?><meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<?php
*/
?>