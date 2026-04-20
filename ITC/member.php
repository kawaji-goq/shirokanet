<?php
function ench($txt) {
	$txt=mb_convert_encoding($txt,"euc-jp");
	return $txt;
}


class Member {
	var $dbobj;
	function Member($dbobj) {
		$this->dbobj=$dbobj;
	}
	
	function GetList() {
		$sql="select * from member order by hurigana";
		$db=$this->dbobj;
		$data=$db->GetList($sql);
		return $data;
	}
	
	function GetList2($id) {
		$sql="select * from member where member_id=".$id;
		$db=$this->dbobj;
		$data=$db->GetData($sql);
		return $data;
	}
	
	function Addition($tablename,$data) {
		$db=$this->dbobj;
		$sql="select max(member_id) as maxid from member";
		$maxid=1;
		$maxdata=$db->GetData($sql);
		$maxid+=$maxdata["maxid"];
		
		/*$insql="insert into ".$tablename." (news_id,title,url,target,registdate)".
				" values (".
				$maxid.",".
				"'".$data["title"]."'".",".
				"'".$data["url"]."'".",".
				"'".$data["target"]."'".",".
				"'".$data["rdate"]."'".
				")";
				
		$result=$db->Query($insql);
		*/
		return $result;
	}
	function Update($tablename,$data) {
	/*
		$upsql=	"update ".$tablename." set ".
				"title = '".$data["title"]."',".
				"url = '".$data["url"]."',".
				"target = '".$data["target"]."',".
				"registdate = '".$data["rdate"]."'".
				" where news_id = ".$data["news_id"];
		$result=$this->dbobj->Query($upsql);
		return $result;
		*/
	}
	function Delete($tablename,$id) {
	/*
		$delsql="delete from ".$tablename." where news_id = ".$id;
		$result=$this->dbobj->Query($delsql);
		*/
		
	}
}
/*
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>